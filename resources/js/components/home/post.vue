<template>
    <div class=" ml-auto mr-auto blog-entries" >
        <a href="blog-single.html" class="blog-entry element-animate fadeIn element-animated" data-animate-effect="fadeIn">
        <img src="https://colorlib.com/preview/theme/wordify/images/img_9.jpg" alt="Image placeholder">
        <div class="blog-content-body">
            <div class="post-meta">
            <span class="author mr-2"><img src="https://colorlib.com/preview/theme/wordify/images/person_1.jpg" alt="Colorlib"> Colorlib</span>•
            <span class="mr-2">March 15, 2018 </span> •
            <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
            </div>
            <h2>How to Find the Video Games of Your Youth</h2>
            <p><strong>Eligendi veniam nam exercitationem totam repellat laboriosam. Sequi eos repellendus repellendus. Neque possimus fuga rem reiciendis et non.</strong></p>
        </div>
        </a>

    </div>
</template>
<script>
export default {
name: 'post-home'
    
}
</script>
<style>

.blog-entries .blog-entry {
  display: block;
  text-decoration: none;
  -webkit-transition: .3s all ease;
  -o-transition: .3s all ease;
  transition: .3s all ease;
  margin-bottom: 30px;
  position: relative; }
  .blog-entries .blog-entry:hover, .blog-entries .blog-entry:focus {
    opacity: .7;
    top: -1px;
    -webkit-box-shadow: 0 3px 50px -2px rgba(0, 0, 0, 0.2) !important;
    box-shadow: 0 3px 50px -2px rgba(0, 0, 0, 0.2) !important; }
  .blog-entries .blog-entry .blog-content-body {
    padding: 20px;
    border: 1px solid #efefef;
    border-top: none; }
  .blog-entries .blog-entry img {
          max-width: 100%;
    max-height: 250px;
    margin-left: auto;
    margin-right: auto;
    display: block;}
  .blog-entries .blog-entry h2 {
    font-size: 18px;
    line-height: 1.5; }
  .blog-entries .blog-entry p {
    font-size: 13px;
    color: gray; }

.blog-entries .post-meta {
  margin-bottom: 20px;
  font-size: 14px;
  color: #b3b3b3; }
  .blog-entries .post-meta .author img {
    width: 30px;
    border-radius: 50%;
    display: inline-block; }

</style>

