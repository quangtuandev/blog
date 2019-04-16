<template>
    <div class="container pdt-6">
        <vue-headful
                :title="'Chỉnh sửa đánh giá ' +info.teacher.name+' | EDUDU - Hệ thống đánh giá chất lượng giảng dạy của giáo viên | edudu.vn'"
                description="Hệ thống đánh giá chất lượng giảng dạy của giáo viên"
        />
        <div class="row">
            <div class="col-md-12">
                <h1>Your comments on <router-link :to="{name:'profile_user' , params:{ id: info.teacher.id }}">{{info.teacher.name}}</router-link> teachers</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7 form-review">
                <form @submit.prevent="addReviewTeacher">
                <div class="rating-star">
                    <span class="field-name">Rating {{cus}}</span>
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
                <textarea class="content-main-rate" v-model="review.content" placeholder="Share your honest experience, and help others make better choices.">
                    
                </textarea>
                </div>
                <div class="rating-title">
                <span class="field-name">Title of your review</span>
                <input type="text" class="content-main-rate" v-model="review.title" >
                </div>
                <div class="submit-button">
                    <input class="btn btn-success btn-lg btn-rv" type="submit" value="Post your review now">
                </div>
                </form>
            </div>
            <div class="col-md-5 form-review">
                <!-- <div class="info-teacher">
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
                </div> -->
            </div>
        </div>
    </div>
</template>
<script>
import { get, post } from '../../helpers/api'
import noty from '../../helpers/noty'
import { getReview } from '../../router/router'
export default {
    name: 'app-review-edit',
    data: () => ({
        review:[],
        info:[],
        star:'',
        cus:'',
    }),

    mounted() {
        get(getReview+this.$route.params.id)
            .then((res)=>{
                this.review         = res.data.detail_review.review
                this.info           = res.data.detail_review.info_review
                this.review.title   = this.review.name
                this.review.content = this.review.description
                this.review.star    = this.review.rating
                console.log(this.review)
            })
            .catch((err)=>{
                if (err.response.data.http_status.code == 404 ||
                        err.response.data.http_status.code == 401) {
                        this.$router.replace('/not-found')
                    }
            })
    }
}
</script>
