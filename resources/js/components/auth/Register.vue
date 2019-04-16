<template>
<div class="landing-page">
  <div class="container pdt-6">
    <vue-headful
                title="Đăng ký EDUDU - Hệ thống đánh giá chất lượng giảng dạy của giáo viên | edudu.vn"
                description="Hệ thống đánh giá chất lượng giảng dạy của giáo viên"
        />

    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin">
          <div class="card-body">
            <h5 class="card-title text-center">Register</h5>
            <span class="hasErrors"></span>
            <form class="form-signin" @submit.prevent="handleRegister" autocomplete="off" novalidate>
              <div class="form-label-group">
                <input type="text" 
                 data-vv-as="name"
                 name="name" v-validate="'required'" 
                 v-model="user.name" 
                 id="inputname" class="form-control fix-height" placeholder="Your name" autofocus>
                <label for="inputname">Your name</label>
              <span class="hasErrors">{{ errors.first('name') }}</span>
              </div>  

              <div class="form-label-group">
                <input type="email" 
                data-vv-as="email" 
                name="email" 
                v-validate="'required|email|unique:users,email'" 
                v-model="user.email" id="inputEmail" class="form-control fix-height" placeholder="Email address" >
                <label for="inputEmail">Email address</label>
              <span class="hasErrors">{{ errors.first('email') }}</span>
              </div>

              <div class="form-label-group">
                <input type="password" ref="password" 
                data-vv-as="password" 
                name="password" 
                v-validate="'required|min:6'" 
                v-model="user.password" id="inputPassword" class="form-control fix-height" placeholder="Password" >
                <label for="inputPassword">Password</label>
              <span class="hasErrors">{{ errors.first('password') }}</span>
              </div>

              <div class="form-label-group">
                <input type="date" 
                data-vv-as="Birthday" 
                name="Birthday" 
                v-validate="'required'" 
                v-model="user.birthday" id="inputbirthday" class="form-control fix-height" placeholder="Your Birthday" >
                <label for="inputbirthday">Birthday</label>
              <span class="hasErrors">{{ errors.first('Birthday') }}</span>
              </div>

              
              <div class="form-label-group">
                <!-- <input type="text"  placeholder="Your Gender" required>-->
                <label id="inputgender">Gender</label> 
                <select 
                data-vv-as="Gender" 
                name="gender"
                 v-validate="'required'" 
                 v-model="user.gender"  class="form-control fix-height">
                            <option v-for="gender in genders" :key="gender.id" :value="gender.value">
                                {{ gender.name }}
                            </option>
                        </select>
              <span class="hasErrors">{{ errors.first('Gender') }}</span>
              </div>


              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit"><i class="fa fa-spinner fa-spin" v-if="spinner"></i> SignUp</button>
              <div class="custom-control mt-3 mb-3">
                <router-link to="password/reset">Forgot your password ?</router-link>
              </div>
              <hr class="my-4">
              <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fa fa-google mr-2"></i> Sign in with Google</button>
              <button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i class="fa fa-facebook-f mr-2"></i> Sign in with Facebook</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</template>
<script>
import { post } from '../../helpers/api'
import { register } from '../../router/router'
export default {
    name:'app-register',
     data(){
      return{
        user: {
          name:'',
          email:'',
          password:'',
          gender:'',
          birthday:''
        },
        genders: [
            { name: 'Other', value: null},
            { name: 'Female', value: 0 },
            { name: 'Male', value: 1 }
        ],
        spinner: false
      }
    },
     methods: {
       handleRegister(){
        this.$validator.validateAll().then((result) => {
          this.spinner = true
          this.$Progress.start()
          post(register, this.user)
              .then(res => {
                  this.spinner = false
                  for (let key in this.user) {
                      this.user[key] = ''
                  }

                  this.$nextTick(function () {
                    this.$validator.reset();
                      this.errors.clear()
                  })

                  this.$router.push({path:'/sent'})
                  this.$Progress.finish()
              })
              .catch(err => {
                  this.spinner = false
                  const message = this.$i18n.t('messages.regiser_fail')
                  this.$Progress.fail()
              })
            })
            .catch(() => {})
        }
      },
      
  }
</script>

<style lang="scss">

</style>
