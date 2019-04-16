<template>
<div class="container main-container mart-top">
    <!-- <vue-headful
                :title="postDetail.name+' | EDUDU - Hệ thống đánh giá chất lượng giảng dạy của giáo viên | edudu.vn'"
                description="Hệ thống đánh giá chất lượng giảng dạy của giáo viên"
        /> -->
    <div class="col-md-12">
    <div class="col-md-12">
        
    <section class="site-section py-lg">
      <div class="container">
        
        <div class="row blog-entries element-animate">

          <div class="col-md-12 col-lg-8 main-content">
            <img :src="'/'+postDetail.image" alt="Image" class="img-fluid mb-5 mr-auto ml-auto">
             <div class="post-meta">
                        <span class="author mr-2"><img :src="postDetail.user.avatar" alt="Colorlib" class="mr-2"> {{postDetail.user.name}}</span>&bullet;
                        <span class="mr-2">{{postDetail.created}} </span> &bullet;
                        <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
                      </div>
            <h1 class="mb-4">{{postDetail.title}}</h1>
            
                <a v-for="category in postDetail.categories" :key="category.id" class="category mb-5" :href="category.id    ">{{category.name}}</a>
            
            <!-- <a class="category mb-5" href="#">Food</a> <a class="category mb-5" href="#">Travel</a> -->
            <div class="des mb-5">
                <strong>{{postDetail.description}}</strong>
            </div>
            <div class="post-content-body" >
                <div v-html="ct"></div>
            </div>

            
            <div class="pt-5">
                <p>  Tags: <a v-for="tag in postDetail.tags" :key="tag.id" href="#">#{{tag.name}} </a> </p>
            </div>


          </div>

          <!-- END main-content -->


          <!-- END sidebar -->

        </div>
      </div>
    </section>

    </div>

    </div>
</div>
</template>
<script>
import {mapState,mapGetters} from 'vuex'
import { get } from "../../helpers/api"
import { detailPost } from '../../router/router'
    export default{
        name: 'app-detail-post',
    
         data() {
            return {
                postDetail:'',
                ct:''
            }
        },
        mounted() {
            get(detailPost+this.$route.params.id)
            .then((res)=>{

                this.postDetail = res.data.detail_posts.post
                moment.lang('en');
                this.postDetail.created = moment(this.postDetail.created_at).format('MMMM Do YYYY, h:mm ');
                this.ct = this.postDetail.content
                console.log(this.postDetail);
                
                
            })
            .catch()
        },
    }
</script>
<style lang="scss" scoped>
.mart-top{
    margin-top: 120px;
}
.author img {
    width: 30px;
    border-radius: 50%;
    display: inline-block; }
.category {
  display: inline-block;
  background: #6610f2;
  padding: 2px 8px;
  line-height: 1.5;
  font-size: 12px;
  border-radius: 4px;
  text-transform: uppercase;
  color: #fff !important;
  margin-right: 10px;
  letter-spacing: .2em; }
</style>
