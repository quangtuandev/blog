<template>
<div class="container emp-profile">
        <vue-headful
                title="EDUDU - Hệ thống đánh giá chất lượng giảng dạy của giáo viên | edudu.vn"
                description="Hệ thống đánh giá chất lượng giảng dạy của giáo viên"
        />
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                    <img :src="dataBasic.avatar" alt=""/>
                    <!-- <div class="file btn btn-lg btn-primary">
                        Change Photo
                        <input type="file" @change="onFileChange($event)" id="file"/>
                    </div> -->
                </div>
        </div>
            <div class="col-md-7">
                <div class="profile-head">
                            <h5>
                                {{dataBasic.name}}
                            </h5>
                            <p>
                                {{dataBasic.about}}
                            </p>
                            <p class="proile-rating">Review : <span>{{reviews.total}}</span></p>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Reviewed</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-1">
                
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-8">
                <div class="tab-content profile-tab" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>User Id</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{dataBasic.id}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Gender</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{dataBasic.gender?'Male':'Female'}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Birthday</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{dataBasic.birthday}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Email</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{dataBasic.email}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Phone</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{dataBasic.phone}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Address</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{dataBasic.address}}</p>
                                    </div>
                                </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <review v-for="review in reviews.data" :review="review" :key="review.id"></review>
                        <center v-if="reviews.current_page != reviews.last_page">
                        <input type="button" class="profile-edit-btn" value="Load More" @click="loadMore" id="loadMore"/>
                        </center>
                    </div>
                </div>
            </div>
        </div>           
</div>
</template>
<script>
import { mapState, mapActions } from 'vuex'
import {get} from '../../helpers/api'
import {detailUser} from '../../router/router'
import Review from '../review/layoutReviewOfUser'
export default {
    name:'app-user-profile',
    components:{
        Review,
    },
    data:() =>{
        return {
        dataBasic:[],
        reviews:[],
        }
    },
    computed:{
        ...mapState('user',[
            'loading',
        ])
    },
    created() {
        // fetch the data when the view is created and the data is
        // already being observed
        this.fetchData()
    },
    watch: {
        // call again the method if the route changes
        '$route': 'fetchData'
    },
    methods:{
        loadMore(){data:this.reviews},
        fetchData() {
            get(detailUser+this.$route.params.id)
                .then((res)=>{
                    this.dataBasic = res.data.user_profile.info
                })
                .catch((err)=>{
                    if (err.response.data.http_status.code == 404 ||
                        err.response.data.http_status.code == 401) {
                        this.$router.replace('/not-found')
                    }
                })
            get(detailUser+this.$route.params.id+'/review')
                .then((res)=>{
                    this.reviews = res.data.review
                })
        }
    },
}
</script>
<style scoped>
.emp-profile{
    padding-top:10px;
    padding-bottom:10px;
    margin-top: 100px;
    margin-bottom: 3%;
    border-radius: 0.5rem;
    background: #fff;
}

.profile-img{
    text-align: center;
}
.profile-img img{
    width: 70%;
    height: 100%;
}
.profile-img .file {
    position: relative;
    overflow: hidden;
    margin-top: -20%;
    width: 70%;
    border: none;
    border-radius: 0;
    font-size: 15px;
    background: #212529b8;
}
.profile-img .file input {
    position: absolute;
    opacity: 0;
    right: 0;
    top: 0;
}
.profile-head h5{
    color: #333;
}
.profile-head h6{
    color: #0062cc;
}
.profile-edit-btn{
    margin: 5px auto;
    border: none;
    border-radius: 1.5rem;
    width: 70%;
    padding: 2%;
    font-weight: 600;
    color: #6c757d;
    cursor: pointer;
}
.proile-rating{
    font-size: 12px;
    color: #818182;
    margin-top: 5%;
}
.proile-rating span{
    color: #495057;
    font-size: 15px;
    font-weight: 600;
}
.profile-head .nav-tabs{
    margin-bottom:5%;
}
.profile-head .nav-tabs .nav-link{
    font-weight:600;
    border: none;
}
.profile-head .nav-tabs .nav-link.active{
    border: none;
    border-bottom:2px solid #0062cc;
}
.profile-work{
    padding: 14%;
    margin-top: -15%;
}
.profile-work p{
    font-size: 12px;
    color: #818182;
    font-weight: 600;
    margin-top: 10%;
}
.profile-work a{
    text-decoration: none;
    color: #495057;
    font-weight: 600;
    font-size: 14px;
}
.profile-work ul{
    list-style: none;
}
.profile-tab label{
    font-weight: 600;
}
.profile-tab p{
    font-weight: 600;
    color: #0062cc;
}
div#home,div#profile {
    padding-right: 5px;
    padding-left: 5px;
}

</style>

