<template>
    <div class="activity-stream-card review-card" >
        <div class="review-card__header">
            <img class="profile-image" :src="review.info_review.user.avatar" :alt="review.info_review.user.name" >
            <div :class="'star-rating star-rating-'+ review.review.rating +' star-rating--medium'">
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
        </div>
        <div class="review-card__author">
            <router-link :to="{ name: 'profile_user',params: { id: review.info_review.user.id } }" >{{review.info_review.user.name}}</router-link>
            reviewed 
            <router-link :to="{ name: 'detail_teacher',params: { id: review.info_review.teacher.id } }" >{{review.info_review.teacher.name}}</router-link>
        </div>
        <div class="review-card__body">
            “{{review.review.name}}” 
        </div>
    </div>
</template>
<script>
    export default {
        props: ['review'],
    }
</script>
