<template>
<div class="pdt-header">
    <section id="img-teacher" class="pt-20 pb-10 container-fluid bg-white">
    <div class="container">
      <div class="row">
        <div class="col-md-6 user-info">
            <div class="profile-img">
                <img src="/images/default_avatar.png">
            </div>
            <div class="info-basic">
                <p class="name">
                    <span>Vo Quang Tuan</span>
                </p>
                <p class="other">
                    quangtuandev@gmail.com
                </p>
            </div>
        </div>
       <div class="col-md-6 user-data">
           <div class="row">
                <div class="col-6">
                        <div class="review">
                            <span class="big-size">1</span>
                            <span><i class="fa fa-star-o" aria-hidden="true"></i> Review</span>
                        </div>
                </div>
                <div class="col-6">
                    <div class="like">
                        <span class="big-size">10</span>
                        <span><i class="fa fa-heart-o" aria-hidden="true"></i> Like</span>
                    </div>
                </div>
            </div>
       </div>
      </div>
    </div>
  </section>
    <vue-headful
        :title="detailReviews.name+' | EDUDU - Hệ thống đánh giá chất lượng giảng dạy của giáo viên | edudu.vn'"
        description="Hệ thống đánh giá chất lượng giảng dạy của giáo viên"
    />
    <div class="container mt-4">
        <div class="col-xs-12 col-md-6 mr-auto ml-auto mt-4">
            <p>Review of <a :href="'/detail-teacher/'+infoTeacher.id">{{infoTeacher.name}}</a></p>
            <div class="card">
                <div class="card-header">
                    <div class="avatar">           
                        <img :src="infoUser.avatar">
                    </div>
                    <div class="over">
                        <div class="name">
                            <span class="name-1">{{infoUser.name}}</span>
                            <router-link :to="{name:'profile_user',params:{ id:infoUser.id }}"><span class="review-1"><i class="fa fa-ravelry" aria-hidden="true"></i> view profile</span></router-link>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <div class="star-line">
                        <div :class="'star-rating star-rating-'+detailReviews.rating+' star-rating--medium'">
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
                        <time datetime="2018-10-22T18:09:36.000+00:00" class="ndate" :title="detailReviews.created">{{ detailReviews.created }}
                        </time>
                    </div>

                    <h5 class="card-title"><router-link :to="{name:'success_created_review',params:detailReviews.id}">{{detailReviews.name}}</router-link></h5>
                    <p class="card-text">{{detailReviews.description}}</p>
                </div>
                <div class="card-footer bg-white">
                    <template v-if="user != null && user.id == detailReviews.user_id">
                        <a href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                        <a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a>
                    </template>
                    <template v-else>
                        <a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i> Drop heart</a>
                    </template>
                    <a href="#"><i class="fa fa-share-square-o" aria-hidden="true"></i> Share</a>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
import moment from 'moment'
import { mapState } from 'vuex'
import { get } from "../../helpers/api"
import { getReview } from '../../router/router'
    export default{
        name: 'app-detail-review',
         data() {
            return {
                detailReviews: [],
                infoUser: [],
                infoTeacher: [],
            }
        },
        mounted() {
            get(getReview+this.$route.params.id)
            .then((res)=>{
                this.detailReviews = res.data.detail_review.review
                this.infoUser = res.data.detail_review.info_review.user
                this.infoTeacher = res.data.detail_review.info_review.teacher
                moment.lang('en')
                // console.log(moment(this.detailReviews.created_at).fromNow())
                this.detailReviews.created = moment(this.detailReviews.created_at).format('MMMM Do YYYY, h:mm ')

            })
            .catch((err)=>{
                if (err.response.data.http_status.code == 404 ||
                        err.response.data.http_status.code == 401) {
                        this.$router.replace('/not-found')
                    }
            })

        },
        computed: mapState('auth', {
            user: state => state.user,  
        }),
    }
</script>
<style lang="scss" scoped>
.card-title {
    margin-top: 1rem;
    clear: both;
    padding-top:20px;
}
.card{
    .card-header{
        display: table;
        .avatar{
            display:table-cell;
            width:75px;
            img{
                border-radius:50%;
                width:50px;
                height:50px;
            }
        }
        .over{
            display:table-cell;
            vertical-align: middle;
            .name{
                .name-1{
                    display:block;
                }
            }
        }
    }
    .card-footer.bg-white{
        display:inline-block;
        a {
            display:inline;
            margin-left: 5px;
        }
    }
}
.star-rating--medium{
    float:left;
}
time{
    float:right;
}
.pdt-header{
    padding-top:90px;
    #img-teacher .row{
        padding:35px;
        .user-info{
            .profile-img{
                display: inline-block;
                img{
                    border-radius: 50%;
                    max-width: 120px;
                    height:auto;
                }
            }
            .info-basic{
                display: inline-block;
                margin-left:35px;
                .name{
                    font-size: 28px;
                }
            }
        }
        .user-data{
            .review,.like{
                display:inline-block;
                text-align: center;
                .big-size{
                    display:block;
                    margin-bottom: 15px;
                    font-size:50px;
                }
            }
            
        }
    }
}
</style>
