<template>
    <div class="container pdt-6">
        <vue-headful
                :title="'Đánh giá '+teacherData.name+' | EDUDU - Hệ thống đánh giá chất lượng giảng dạy của giáo viên | edudu.vn'"
                description="Hệ thống đánh giá chất lượng giảng dạy của giáo viên"
        />
        <div class="row">
            <div class="col-md-12">
                <h1>Your comments on <router-link :to="{name:'profile_user' , params:{ id: teacherData.id }}">{{teacherData.name}}</router-link> teachers</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7 form-review">
                <form @submit.prevent="addReviewTeacher">
                <div class="rating-star">
                    <span class="field-name">Rating</span>
                    <div class="star-selector__descriptions">
                    <span>Hover over stars or click to rate.</span>
                    </div>
                    <div class="quick-evaluate__rating">
                    <div class="quick-evaluate__rating-evaluate">
                        <div :class="'star-rating star-selector star-rating--large star-rating-'+review.star">
                            <div class="star-item star-item--color">
                                    <img @mouseover="[cus = review.star, review.star = 1]"
                                        @mouseleave="review.star = cus"
                                        @click="cus = review.star=1"
                                        src="/images/single-star-transparent.svg" alt="Star 1">
                            </div>
                            <div class="star-item star-item--color">
                                    <img @mouseover="[cus = review.star, review.star = 2]"
                                        @mouseleave="review.star = cus"
                                        @click="cus = review.star = 2"
                                        src="/images/single-star-transparent.svg" alt="Star 2">
                            </div>
                            <div class="star-item star-item--color">
                                    <img @mouseover="[cus = review.star, review.star = 3]"
                                        @mouseleave="review.star = cus"
                                        @click="cus = review.star =3"
                                        src="/images/single-star-transparent.svg" alt="Star 3">
                            </div>
                            <div class="star-item star-item--color">
                                    <img @mouseover="[cus = review.star, review.star = 4]"
                                        @mouseleave="review.star = cus"
                                        @click="cus = review.star = 4"
                                        src="/images/single-star-transparent.svg" alt="Star 4">
                            </div>
                            <div class="star-item star-item--color">
                                    <img @mouseover="[cus = review.star, review.star = 5]"
                                        @mouseleave="review.star = cus"
                                        @click="cus = review.star = 5"
                                        src="/images/single-star-transparent.svg" alt="Star 5">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="star-selector__descriptions">
                    <span v-if="star == 1" >1 star: Bad – unacceptable experience, unreasonable and rude conduct.</span>
                    <span v-if="star == 2" >2 stars: Poor – an inadequate experience with a lot of friction.</span>
                    <span v-if="star == 3" >3 stars: Average – acceptable experience but with some friction.</span>
                    <span v-if="star == 4" >4 stars: Great – decent treatment and very little friction.</span>
                    <span v-if="star == 5" >5 stars: Excellent – no reservations, I would recommend this company to anyone.</span>
                </div>
                </div>
                <div class="rating-content">
                <span class="field-name">Your review</span>
                <textarea class="content-main-rate" v-model="review.content" placeholder="Share your honest experience, and help others make better choices."></textarea>
                </div>
                <div class="rating-title">
                <span class="field-name">Title of your review</span>
                <input type="text" class="content-main-rate" v-model="review.title">
                </div>
                <div class="submit-button">
                    <input class="btn btn-success btn-lg btn-rv" type="submit" value="Post your review now">
                </div>
                </form>
            </div>
            <div class="col-md-5 form-review">
                <div class="info-teacher">
                    <div class="card card--related">
                        <div class="card-left">
                            <h3 class="title-company-w fs-20">Thông tin</h3>
                            <p>Gender: {{teacherData.gender?'Male':'Female'}}</p>
                            <p>birthday: {{teacherData.birthday}}</p>
                            <p>address: {{teacherData.address}}</p>
                            <p>phone: {{teacherData.phone}}</p>
                            <p>specialize: {{teacherData.specialize}}</p>
                            <p>email: {{teacherData.email}}</p>
                        </div>
                    </div>
                    <div class="card card--related">
                        <div class="card-left">
                            <h3 class="title-company-w fs-20">Giới thiệu</h3>
                            <p>{{teacherData.description}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { get, post } from '../../helpers/api'
import noty from '../../helpers/noty'
import { detailTeacher, postReviewTeacher } from '../../router/router'
export default {
    name: 'app-review',
    data: () => ({
        review: {
            star: '',
            content: '',
            title:'',
            teacher_id:''
        },
        star: '',
        teacherData:[],
        cus: ''
    }),
    created() {
    if( this.$route.query.stars != '')
        {
            this.review.star = this.$route.query.stars
        }
    this.review.teacher_id = this.$route.params.id
    },
    mounted() {
        get(detailTeacher+this.$route.params.id)
            .then((res)=>{
                this.teacherData = res.data.detail_teachers.teacher
            })
            .catch((err)=>{
                if (err.response.data.http_status.code == 404 ||
                        err.response.data.http_status.code == 401) {
                        this.$router.replace('/not-found')
                    }
            })
    },
    methods:{
        getData(review){
            console.log(this.review)
        },
         addReviewTeacher(){
            this.$Progress.start()
            post(postReviewTeacher,this.review)
            .then((res)=>{
                // console.log(res.data.review.id)params: { userId } 

                this.$router.push({name: 'success_created_review', params: { id: res.data.review.id }})
                this.$Progress.finish()
            })
            .catch(err=>{
                noty({type: 'error', text: "Don't create your review", force: true})
                this.$Progress.fail()
            })
        }
    }
}
</script>

<style>
.col-md-7.form-review {
    padding: 50px 25px;
    background: #ffebeb;
    border: 1px solid #12cd6a;
}
.form-review .info-teacher>.card{
    margin-top:0;
    padding: 50px 25px;
}

.rating-content {
    margin: 25px auto;
}

span.field-name {
    display: block;
    font-style: italic;
    margin-bottom: 10px;
    font-size: 25px;
    font-weight: bolder;
    color: #9427d6;
}
input.btn.btn-success.btn-lg.btn-rv {
    width: 100%;
    margin-top: 25px;
}
textarea.content-main-rate {
    width: 100%;
    height: 130px;
}

input.content-main-rate {
    width: 100%;
    height: 35px;
}
.star-selector__descriptions {
    color:#7e7e7e;
    font-size:14px;
    font-style:italic;
    margin:0;
    padding-top:5px;
}
@media (max-width:768px) {
    .col-md-7.form-review {

    margin: 10px 15px;
    
}
}
    @media only screen and (max-width:570px){
        .star-selector__descriptions {
            float:none;
            width:auto;
            margin-top:10px;
            margin-bottom:25px;
            height:auto
        }
    }

</style>
