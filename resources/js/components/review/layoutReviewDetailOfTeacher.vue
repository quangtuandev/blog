<template>
<!--Search Result 01-->
<div class="card card--related">
    <div class="review-stack">
        <article class="review-card">
            <section class="review-card__content-section">
                <aside class="content-section__consumer-info">
                    <router-link :to="{ name:'profile_user', params: { id: review.user.id } }"  class="consumer-info">
                        <div class="consumer-info__picture-wrapper"><img alt="Bret" :src="review.user.avatar" class="consumer-info__image"></div>
                        <div class="consumer-info__details">
                            <h3 class="consumer-info__details__name">
                                {{review.user.name}}
                            </h3>
                            <!-- <div>
                                <span class="consumer-info__details__review-count">5 rating </span>
                            </div> -->
                        </div>
                    </router-link>
                </aside>
                <section class="content-section__review-info">
                    <div class="review-info__header">
                        <div class="review-info__header__verified">
                            <div :class="'star-rating star-rating-'+review.rating+' star-rating--medium'">
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
                            <div class="header__verified__date">
                                <time datetime="2018-10-22T18:09:36.000+00:00" class="ndate" :title="review.created">{{review.created}}
                                    <span title="2018-10-22T18:09:36.000+00:00"></span>
                                </time>
                            </div>
                        </div>
                    </div>
                    <div class="review-info__body">
                        <h2 class="review-info__body__title">
                            <router-link :to="{name:'success_created_review',params:{id: review.id }}">{{ review.name }}</router-link>
                        </h2>
                        <p class="review-info__body__text">
                            {{review.description}}
                        </p>
                    </div>
                    <div class="review-info__options">
                        <div class="card-footer bg-white">
                            <template v-if="user != null && user.id == review.user_id">
                                <a href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                                <a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a>
                            </template>
                            <template v-else>
                                <a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i> Drop heart</a>
                            </template>
                            <a href="#"><i class="fa fa-share-square-o" aria-hidden="true"></i> Share</a>
                        </div>
                    </div>
                </section>
            </section>
        </article>
    </div>
</div>
<!--Search Result 01-->
</template>
<script>
import moment from 'moment'
import { mapState } from 'vuex'
export default {
    props:['review'],
    created(){
        this.review.created = moment(this.review.created_at).format('Do MMMM YYYY, h:mm ')
    },
    computed: mapState('auth', {
            user: state => state.user,  
    }),
}
</script>
<style lang="scss" scoped> 
.card.card--related{
    margin-top:10px;
}
.review-list {
    .card {
        .stack-item {
            border: 1px solid #d4d4d4;
            border-top: none;
            padding: 16px;
            background-color: #f2f2f2
        }
        .star-rating {
            width: 100%;
            display: flex
        }
        .star-rating-1{
            .star-item--color:nth-last-child(n+5) {
                background-color: #ff3722
            }
        }
        .star-rating-2{
            .star-item--color:nth-last-child(n+4) {
                background-color: #ff8622
            }
        }
        .star-rating-3{
            .star-item--color:nth-last-child(n+3) {
                background-color: #ffce00
            }
        }
        .star-rating-4{
            .star-item--color:nth-last-child(n+2) {
                background-color: #73cf11
            }
        }
        .star-rating-5{
            .star-item--color {
                background-color: #00b67a
            }
        }
        .star-rating--small {
            width: 88px;
            height: 16px;
            .star-item {
                width: 16px
            }
            .star-item:not(:last-of-type) {
                margin-right: 2px
            }
        }
        .star-rating--medium {
            width: 108px;
            height: 20px;
            .star-item {
                width: 20px
            }
            .star-item:not(:last-of-type) {
                margin-right: 2px
            }
        }
        .star-rating--large {
            width: 216px;
            height: 40px;
            .star-item {
                width: 40px
            }
            .star-item:not(:last-of-type) {
                margin-right: 4px
            }
        }
        .star-item {
            background-color: #e5e5e5;
            flex: 1
            img {
                max-width: 100%
            }
        }
        .star-item:not(:last-of-type) {
            margin-right: 1.5%
        }
        .review-card {
            display: flex;
            flex-direction: column;
            padding-bottom: 16px
        }
        .review-card__content-section {
            padding: 16px 16px 0
        }
        .content-section__consumer-info {
            width: 100%;
            word-break: break-word
        }
        .content-section__review-info {
            word-break: break-word
        }
        .consumer-info {
            display: flex;
            color: #292929;
            margin-bottom: 8px
        }
        .consumer-info__image {
            border-radius: 50%;
            width: 48px;
            height: 48px;
            margin-right: 16px;
            margin-bottom: 16px
        }
    }
}


@media only screen and (min-width:768px) {
    .review-list .card .stack-item {
        padding: 24px 24px 24px 144px
    }
}

@media only screen and (min-width:1024px) {
    .review-list .card .review-card {
        max-width: 100%;
        padding-bottom: 24px
    }
}

@media only screen and (min-width:768px) {
    .review-list .card .review-card__content-section {
        padding: 24px 24px 0;
        display: flex;
        flex-direction: row;
        width: 100%
    }
}

@media only screen and (min-width:768px) {
    .review-list .card .content-section__consumer-info {
        width: 112px;
        margin-right: 16px
    }
}

@media only screen and (min-width:768px) {
    .review-list .card .content-section__review-info {
        width: 100%;
        flex: 1
    }
}

@media only screen and (min-width:768px) {
    .review-list .card .consumer-info {
        flex-direction: column
    }
}


.review-list .card .consumer-info__details {
    margin-bottom: 8px
}

.review-list .card .consumer-info__details__name {
    font-size: 14px;
    margin: 0;
    line-height: 20px;
    font-weight: 700;
    flex-basis: 100%;
    color: #292929
}
.review-list .card .consumer-info__details__review-count {
    color: #7e7e7e;
    font-size: 14px;
    line-height: 16px
}

.review-list .card .review-info__header {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap
}

.review-list .card .review-info__header .star-rating {
    margin: 0 8px 8px 0
}

@media only screen and (min-width:768px) {
    .review-list .card .review-info__header .star-rating {
        margin: 0 8px 16px 0;
        order: 1
    }
}

.review-list .card .review-info__header .ndate {
    color: #7e7e7e
}

@media only screen and (min-width:768px) {
    .review-list .card .review-info__header .ndate {
        flex-basis: 50%;
        order: 2;
        text-align: right
    }
}

.review-list .card .review-info__header__verified {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    width: 100%
}

.review-list .card .review-info__body__text,
.review-list .card .review-info__body__title {
    margin: 0 0 16px
}

.review-list .card .review-info__body__text,
.review-list .card .review-info__body__title {
    overflow-wrap: break-word;
    word-break: break-word
}

.review-list .card .header__verified__date {
    order: 2;
    display: flex;
    flex-direction: column;
    color: #7e7e7e
}

@media only screen and (min-width:768px) {
    .review-list .card .header__verified__date {
        text-align: right
    }
}
.review-info__options{
    border-top: solid 1px #7e7e7e;
    .card-footer.bg-white{
        display:inline-block;
        border:none;
        a {
            display:inline;
            margin-left: 5px;
        }
    }
}
</style>

