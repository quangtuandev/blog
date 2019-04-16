<template>
<div class="card">
    <div class="card-header">
        Reviewed <router-link :to="'/detail-teacher/'+review.teacher.id">{{review.teacher.name}}</router-link>
        <time datetime="2018-10-22T18:09:36.000+00:00" class="ndate" :title="review.created">{{this.review.created}}
            <span title="2018-10-22T18:09:36.000+00:00"></span>
        </time>
    </div>
    <div class="card-body">
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
        <h5 class="card-title">{{review.name}}</h5>
        <p class="card-text">{{review.description}}</p>
    </div>
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
</template>
<script>
import { mapState } from 'vuex'
export default {
    name:'app-review-user',
    props:['review'],
    created() {
        this.review.created = moment(this.review.created_at).format('Do MMMM YYYY, h:mm ')
        // this.review.created = moment(this.review.created_at).format('MMMM Do YYYY, h:mm ')
    },
    computed: mapState('auth', {
            user: state => state.user,  
    }),
}
</script>
<style lang="scss" scoped>
.card-title {
    margin-top: 1rem;
}
.card{
    margin-top: 10px;
}
time{
    float:right;
}
.card-footer.bg-white{
    display:inline-block;
    border-top: solid 1px #DFDFDE;
    a {
        display:inline;
        margin-left: 5px;
    }
}
</style>

