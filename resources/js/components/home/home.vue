<template>
<div id="home">
     <vue-headful
                title="EDUDU -  chất lượng đến từng bình luận | "
                description=" chất lượng đến từng bình luận"
        />
        <section class="hero">
            <div class="hero-container">
                <h1 class="hero-title">
                    Behind every review is an experience that matters
                </h1>
                <h2 class="hero-sub-title">
                    Read reviews. Write reviews. Find teachers. Find users.
                </h2>
                <form class="hero__search-form search-form" autocomplete="false">
                    <span class="hero__search-form__placeholder-icon fa fa-search"></span>
                    <input class="hero__search-input search-input"
                        v-model="keyword"
                        @keyup.enter="searchRedirect"
                        @input="search"
                        placeholder="Find teachers... Find users..."
                        type="text">
                    <button class="hero__search-form__submit" @click.prevent="searchRedirect" aria-label="Search">
                        <span class="hero__search-form__submit__text">Search</span>
                        <span class="hero__search-form__submit__icon fa fa-search"></span>
                    </button>
                </form>
                
            <div class="user-result">
                <div class="row activity-stream-card review-card search-result " v-for="result in teachersFinded"  :key="result.id">
                    <div class="col-md-2 review-card__header">
                        <img class="profile-image search-img"  :src="result.image" :alt="result.name" >
                    </div>
                    <div class="col-md-4">
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
                    
                <div class="row activity-stream-card review-card search-result " v-for="result in usersFinded"  :key="result.id">
                    <div class="col-md-2 review-card__header">
                        <img class="profile-image search-img" :src="result.avatar" :alt="result.name" >
                    </div>
                    <div class="review-card__author" style="text-align:left">
                        <router-link :to="{name:'profile_user' , params:{ id: result.id }}">{{result.name}}</router-link>
                        <br>Email: {{result.email}}
                    </div>
                </div>
            </div>
        </div>
        </section>
        <section class="container bg-white">
            <div class="row">
            <div class="col-md-12 col-lg-8 main-content">
            <post></post>
            <post></post>
            <post></post>

            </div>
            <SideBar />
            </div>
        </section>
        <!-- <section class="stream">
            <post></post>
            <h2 class="activity-stream-header">Recent reviews</h2>
            <div class="activity-stream-wrapper" >
                
                <div class="activity-stream-column-container" >
                    
                    <div class="activity-stream-column" >
                        <review v-for="review in reviews.slice(0, 2)" :review="review" :key="review.review.id"></review>
                    </div>
                    <div class="activity-stream-column" >
                        <review v-for="review in reviews.slice(2, 4)" :review="review" :key="review.review.id"></review>
                    </div>
                    <div class="activity-stream-column" >
                        <review v-for="review in reviews.slice(4, 6)" :review="review" :key="review.review.id"></review>
                    </div>
                    <div class="activity-stream-column" >
                        <review v-for="review in reviews.slice(6, 8)" :review="review" :key="review.review.id"></review>
                    </div>
                    <div class="activity-stream-column" >
                        <review v-for="review in reviews.slice(8, 10)" :review="review" :key="review.review.id"></review>
                    </div>
                    
                </div>
            </div>
        </section> -->
</div>
</template>
<script>
    import Review  from "../review/layoutReview";
    import { get } from "../../helpers/api"
    import { getReviewLastest } from "../../router/router"
    import _ from 'lodash'
    import { EventBus }  from '../../EventBus'
    import Post from './post'
    import SideBar from '../layouts/partials/SideBar'
    export default {
        components: {
            Post,
            SideBar
        },
        data() {
            return {
                reviews: [],
                keyword: '',
                usersFinded: [],
                teachersFinded: [],
            }
        },
        created () {
            EventBus.$on('redirect-page', () => {
                        this.keyword = ''
                        this.search()
                    })
        },
        mounted() {
            get(getReviewLastest).then((response) => {
                this.reviews = response.data.review_lastest.reviews
                
            });
            // this.$emit('loading',true)
        },
        methods:{
            search: _.debounce(function () {
            if (this.keyword.trim()) {
                get(`search?keyword=${this.keyword}`)
                    .then(res => {
                        this.usersFinded = res.data.users
                        this.teachersFinded = res.data.teachers
                    })
                    .catch(err => {
                        noty({
                            // text: this.$i18n.t('messages.connection_error'),
                            container: false,
                            force: true
                        })
                    })
            } else {
                 this.usersFinded = this.teachersFinded = []
            }
        }, 500),
        searchRedirect(){
            this.$router.push({ name: 'search', params: { keyword: this.keyword }})
            this.keyword = ''
            this.search()
        }
        }
    }
    
</script>

<style lang="scss" scoped>
#home{   
    margin-top: 85px; 
    font-family: 'Open Sans', sans-serif;
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
.user-result {
    position: absolute;
    /* height: 500px; */
    max-width: 600px;
    width: 100%;
    z-index: 999;
}
</style>

