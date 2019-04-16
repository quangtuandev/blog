<template>
    
          <div class="col-md-12 col-lg-4 sidebar">
            <div class="sidebar-box search-form-wrap">
              <form action="#" class="search-form">
                <div class="form-group">
                  <span class="icon fa fa-search"></span>
                  <input type="text" class="form-control" id="s" placeholder="Type a keyword and hit enter">
                </div>
              </form>
            </div>
            <!-- END sidebar-box -->
            <div class="sidebar-box">
              <div class="bio text-center">
                <img src="https://colorlib.com/preview/theme/wordify/images/person_2.jpg" alt="Image Placeholder" class="img-fluid">
                <div class="bio-body">
                  <h2>Craig David</h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem facilis sunt repellendus excepturi beatae porro debitis voluptate nulla quo veniam fuga sit molestias minus.</p>
                  <p><a href="#" class="btn btn-primary btn-sm rounded">Read my bio</a></p>
                  <p class="social">
                    <a href="#" class="p-2"><span class="fa fa-facebook"></span></a>
                    <a href="#" class="p-2"><span class="fa fa-twitter"></span></a>
                    <a href="#" class="p-2"><span class="fa fa-instagram"></span></a>
                    <a href="#" class="p-2"><span class="fa fa-youtube-play"></span></a>
                  </p>
                </div>
              </div>
            </div>
            <!-- END sidebar-box -->  
            <div class="sidebar-box">
              <h3 class="heading">Popular Posts</h3>
              <div class="post-entry-sidebar">
                <ul>
                  <li>
                    <a href="">
                      <img src="https://colorlib.com/preview/theme/wordify/images/img_1.jpg" alt="Image placeholder" class="mr-4">
                      <div class="text">
                        <h4>There’s a Cool New Way for Men to Wear Socks and Sandals</h4>
                        <div class="post-meta">
                          <span class="mr-2">March 15, 2018 </span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="">
                      <img src="https://colorlib.com/preview/theme/wordify/images/img_1.jpg" alt="Image placeholder" class="mr-4">
                      <div class="text">
                        <h4>There’s a Cool New Way for Men to Wear Socks and Sandals</h4>
                        <div class="post-meta">
                          <span class="mr-2">March 15, 2018 </span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="">
                      <img src="https://colorlib.com/preview/theme/wordify/images/img_1.jpg" alt="Image placeholder" class="mr-4">
                      <div class="text">
                        <h4>There’s a Cool New Way for Men to Wear Socks and Sandals</h4>
                        <div class="post-meta">
                          <span class="mr-2">March 15, 2018 </span>
                        </div>
                      </div>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <!-- END sidebar-box -->

            <div class="sidebar-box">
              <h3 class="heading">Categories</h3>
              <ul class="categories">
                <li><a href="#">Food <span>(12)</span></a></li>
                <li><a href="#">Travel <span>(22)</span></a></li>
                <li><a href="#">Lifestyle <span>(37)</span></a></li>
                <li><a href="#">Business <span>(42)</span></a></li>
                <li><a href="#">Adventure <span>(14)</span></a></li>
              </ul>
            </div>
            <!-- END sidebar-box -->

            <div class="sidebar-box">
              <h3 class="heading">Tags</h3>
              <ul class="tags">
                <li><a href="#">Travel</a></li>
                <li><a href="#">Adventure</a></li>
                <li><a href="#">Food</a></li>
                <li><a href="#">Lifestyle</a></li>
                <li><a href="#">Business</a></li>
                <li><a href="#">Freelancing</a></li>
                <li><a href="#">Travel</a></li>
                <li><a href="#">Adventure</a></li>
                <li><a href="#">Food</a></li>
                <li><a href="#">Lifestyle</a></li>
                <li><a href="#">Business</a></li>
                <li><a href="#">Freelancing</a></li>
              </ul>
            </div>
          </div>
</template>
<script>
export default {
    
}
</script>
<style lang="scss" scoped>


.sidebar {
  padding-left: 5em; }
  @media (max-width: 991.98px) {
    .sidebar {
      padding-left: 15px; } }

.sidebar-box {
  margin-bottom: 4em;
  font-size: 15px;
  width: 100%;
  float: left;
  background: #fff; }
  .sidebar-box *:last-child {
    margin-bottom: 0; }
  .sidebar-box .heading {
    font-size: 18px;
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 1px solid #e6e6e6; }

.tags {
  padding: 0;
  margin: 0;
  font-weight: 400; }
  .tags li {
    padding: 0;
    margin: 0 4px 4px 0;
    display: inline-block; }
    .tags li a {
      float: left;
      display: block;
      border-radius: 4px;
      padding: 2px 6px;
      color: gray;
      background: #f2f2f2; }
      .tags li a:hover {
        color: #fff;
        background: #6610f2; }

.pagination {
  margin-bottom: 5em;
  text-align: center !important;
  display: block; }
  .pagination li {
    margin-right: 2px;
    margin-bottom: 3px;
    display: inline-block; }
    .pagination li a {
      border-radius: 50% !important;
      width: 40px;
      height: 40px;
      line-height: 40px;
      padding: 0;
      margin: 0;
      display: inline-block;
      text-align: center; }
      .pagination li a:focus, .pagination li a:active {
        -webkit-box-shadow: none !important;
        box-shadow: none !important; }
      .pagination li a:hover {
        background: #6610f2;
        color: #fff;
        border: 1px solid transparent; }
    .pagination li.active a {
      border: 1px solid transparent !important; }

.categories, .sidelink {
  padding: 0;
  margin: 0;
  font-weight: 400; }
  .categories li, .sidelink li {
    padding: 0;
    margin: 0;
    position: relative;
    margin-bottom: 10px;
    padding-bottom: 10px;
    border-bottom: 1px dotted #dee2e6;
    list-style: none; }
    .categories li:last-child, .sidelink li:last-child {
      margin-bottom: 0;
      border-bottom: none;
      padding-bottom: 0; }
    .categories li a, .sidelink li a {
      display: block;
      font-size: 16px; }
      .categories li a span, .sidelink li a span {
        position: absolute;
        right: 0;
        top: 0;
        color: #ccc;
        -webkit-transition: .3s all ease;
        -o-transition: .3s all ease;
        transition: .3s all ease; }
      .categories li a:hover span, .sidelink li a:hover span {
        color: #000; }
    .categories li.active a, .sidelink li.active a {
      color: #000;
      font-style: italic; }

.post-entry-sidebar .post-meta {
  font-size: 14px;
  color: #b3b3b3; }

.post-entry-sidebar ul {
  padding: 0;
  margin: 0; }
  .post-entry-sidebar ul li {
    list-style: none;
    padding: 0 0 20px 0;
    margin: 0 0 20px 0; }
    .post-entry-sidebar ul li a {
      display: table; }
      .post-entry-sidebar ul li a img {
        width: 90px; }
      .post-entry-sidebar ul li a img, .post-entry-sidebar ul li a .text {
        display: table-cell;
        vertical-align: middle; }
      .post-entry-sidebar ul li a .text h4 {
        font-size: 18px; }

.search-form-wrap {
  margin-bottom: 5em;
  display: block; }

.search-form .form-group {
  position: relative; }
  .search-form .form-group #s {
    padding-right: 50px;
    background: #f7f7f7;
    padding: 15px 15px;
    border: none; }

.search-form .icon {
  position: absolute;
  top: 50%;
  right: 20px;
  -webkit-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  transform: translateY(-50%); }

</style>
