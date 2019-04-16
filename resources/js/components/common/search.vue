<template>
<div class="pdt-6">
    <div class="search-rs row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="mrg-top ui-block">
                <div class="ui-block-title">
                    <h6 class="title">
                        Tìm thấy {{totalTeacher}}  giáo viên với từ khoá "{{keyword}}"
                    </h6>
                </div>
            </div>
        </div>
        <div class="col-md-4"  v-if="teachersFinded" v-for="result in teachersFinded"  :key="result.id">
            <div class="activity-stream-card review-card row">
                <div class="col-md-3 review-card__header">
                        <img class="profile-image search-img"  :src="result.image" :alt="result.name" >
                    </div>
                    <div class="col-md-9">
                        <div :class="'star-rating star-rating-'+result.overView.star+' star-rating--medium'">
                            <div class="star-item star-item--color">
                                <img src="/images/single-star-transparent.svg" alt="Star 1">
                            </div>
                            <div class="star-item star-item--color">
                                <img src="/images/single-star-transparent.svg" alt="Star 2">
                            </div>
                            <div class="star-item star-item--color">
                                <img src="/images/single-star-transparent.svg" alt="Star 3">
                            </div>
                            <div class="star-item star-item--color">
                                <img src="/images/single-star-transparent.svg" alt="Star 4">
                            </div>
                            <div class="star-item star-item--color">
                                <img src="/images/single-star-transparent.svg" alt="Star 5">
                            </div>
                        </div>
                        <div class="review-card__author" style="text-align:left">Rating: {{result.overView.count}}<br>Score: {{result.overView.avg }}/5
                        </div>
                    </div>
                    <div class="review-card__author" style="text-align:left">
                        <router-link :to="{name: 'detail_teacher', params:{ id: result.id }}">{{result.name}}</router-link>
                    <br>specialize: {{result.specialize}}
                        <br>Email: {{result.email}}
                    </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="mrg-top ui-block">
                <div class="ui-block-title">
                    <h6 class="title">
                        Tìm thấy {{totalUser}} user với từ khoá "{{keyword}}"
                    </h6>
                </div>
            </div>
        </div>
        <div class="col-md-4" v-if="usersFinded" v-for="result in usersFinded"  :key="result.id">
            <div class="activity-stream-card review-card row">
                <div class="col-md-3 review-card__header">
                    <img class="profile-image search-img" :src="result.avatar" :alt="result.name" >
                </div>
                <div class="review-card__author" style="text-align:left">
                    <router-link :to="{name:'profile_user' , params:{ id: result.id }}">{{result.name}}</router-link>
                    <br>Email: {{result.email}}
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
import { get } from '../../helpers/api'
    export default {
        name: 'app-search',
        data: () => ({
            usersFinded: [],
            teachersFinded: [],
            totalUser: 0,
            totalTeacher: 0
        }),
        computed: {
            keyword() {
                return this.$route.params.keyword
            }
        },
        created() {
            this.getResult()
        },
        methods:{
            getResult(){
                get(`search?keyword=${this.$route.params.keyword}`)
                    .then(res => {
                        this.usersFinded = res.data.users
                        this.teachersFinded = res.data.teachers
                        this.totalUser = this.usersFinded.length
                        this.totalTeacher = this.teachersFinded.length
                        console.log(this.totalTeacher)
                    })
                    .catch(err => {
                        noty({
                            // text: this.$i18n.t('messages.connection_error'),
                            container: false,
                            force: true
                        })
                    })
            }
        }
    }
</script>
<style lang="scss" scoped>
.activity-stream-card{
    transition: none;
}
.activity-stream-card:hover{
    transform: none;
    transition: none;
}
    .ui-block {
        background-color: #fff;
        border-radius: 5px;
        border: 1px solid #e6ecf5;
        margin-bottom: 15px;
    }
    
    .ui-block-title {
        padding: 23px 25px 18px;
        line-height: 1;
        border-bottom: 1px solid #e6ecf5;
        border-top: 1px solid #e6ecf5;
        display: table;
        width: 100%;
        position: relative;
    }
    
    .ui-block-title .title {
        color: #515365;
    }
    .search-rs.row {
        padding-left: 50px;
        padding-right: 50px;
        margin:0;
    }
    .review-card__author{
        // margin-left: 50px;
        margin-top:5px;
    }
    @media(max-width:768px){
        .search-rs.row {
        padding-left: 25px;
        padding-right: 25px;
    }
    }
    .search-result.activity-stream-card{
    padding-top: 6px;
    padding-bottom: 6px;
    margin:0px;
    border-top: 1px solid #e3f2fd;
}
.review-card__header .profile-image.search-img{
    width: 65px;
    height: 65px;
}
</style>