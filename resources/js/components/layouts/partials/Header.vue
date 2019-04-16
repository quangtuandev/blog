<template>
    <nav class="navbar navbar-expand-lg navbar-light">
  <router-link :to="{ name: 'homepage' }" class="nav-link">
      <img src="/images/logo2.png" alt="">
  </router-link>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <form class="form-inline my-2 my-lg-0 form-search-header">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fas fa-search"></i>  Search</button>
    </form>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="#">Write Review<span class="sr-only"></span></a>
      </li>
      <template  v-if="!user">
        <li class="nav-item" >
        <router-link :to="{ name: 'login' }" class="nav-link">Login</router-link>
        <!-- <a class="nav-link" href="#">Login</a> -->
      </li>
      <li class="nav-item">
        <router-link :to="{ name: 'register' }" class="nav-link">Register</router-link>
        <!-- <a class="nav-link" href="#">Register</a> -->
      </li>
      <!-- user logined -->
      
      </template>
      
      <template v-else>
        <li class="nav-item">
        <div class="avt-header">
          <img :src="user.avatar" alt="your avatar" width="32px">
        </div> 
      </li>
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{user.name}}
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <router-link class="dropdown-item" :to="{name:'profile_user',params:{ id:user.id }}">My profile</router-link>
          <a class="dropdown-item" href="#">My Account</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item"  v-on:click="handleLogout()">Logout  <i class="fas fa-sign-out-alt"></i></a>
        </div>
      </li>
      </template>
      <li class="nav-item teachers">
        <router-link :to="{ name: 'newteacher' }" class="nav-link">Top Teachers</router-link>

      </li>
    </ul>
  </div>
</nav>

</template>
<script>
import { mapGetters,mapActions,mapState } from 'vuex'
import { post } from '../../../helpers/api'
import { logout } from '../../../router/router'
    export default {
        name:'app-header',
         computed: {
           ...mapGetters('auth',['user']),
           ...mapState('auth', {
            authenticated: state => state.authenticated,
            user: state => state.user,
        })
        },
        methods:{
          ...mapActions('auth', [
            'logout',
        ]),
          handleLogout(){
             post(logout).then(res => {
                this.logout()
                this.$router.push('/login')
            }).catch(err => {
                this.$router.push('/')
            })
          }
        }
    }
</script>
<style>
.form-search-header{
  display: none;
}
.navbar.navbar-expand-lg.navbar-light{
    background-color: rgb(227, 242, 253);
    position: fixed;
    z-index: 100;
    width: 100%;
  }
@media (min-width: 992px){
  .navbar{
    padding : .5rem 6em!important;
    
  }
  .teachers{
    border: 1px solid #000;
    border-radius: 3px; 
    padding: 0px 13px;
  }
  .teachers:hover{
    background: #000;
    border: 1px solid #fff;
    border-radius: 3px; 
  }
  .teachers>a:hover{
    color: aliceblue!important;
  }
}
</style>
