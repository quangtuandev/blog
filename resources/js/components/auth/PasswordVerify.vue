<template>
<div class="landing-page">
  <div class="container pdt-6">
    <vue-headful
                title="Tạo mật khẩu mới EDUDU - Hệ thống đánh giá chất lượng giảng dạy của giáo viên | edudu.vn"
                description="Hệ thống đánh giá chất lượng giảng dạy của giáo viên"
        />

    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin">
          <div class="card-body">
            <h5 class="card-title text-center">Reset password </h5>
            <span class="hasErrors"></span>
            <form class="form-signin"  @submit.prevent="updatePassword" autocomplete="off" novalidate>
                <span v-show="messageValidate" class="hasErrors">
                   {{ messageValidate }}
                </span>
            <div class="form-label-group">
                <input type="email" 
                data-vv-as="email" 
                name="email" 
                v-validate="'required|email'" 
                v-model="user.email" id="inputEmail" class="form-control fix-height" placeholder="Email address" >
                <label for="inputEmail">Email address</label>
              <span class="hasErrors">{{ errors.first('email') }}</span>
              
              </div>
              <div class="form-label-group">
                <input type="password" 
                data-vv-as="Password" 
                name="password" 
                v-validate="'required|min:6'"
                ref="password" 
                v-model="user.password" id="inputpassword" class="form-control fix-height" placeholder="New password " >
                <label for="inputpassword">New password </label>
              <span class="hasErrors">{{ errors.first('password') }}</span>
              </div>
              <div class="form-label-group">
                <input type="password" 
                data-vv-as="password confirmation" 
                name="password confirmation" 
                v-validate="'required|confirmed:password'" 
                v-model="user.password_confirmation" id="confirmation" class="form-control fix-height" placeholder="New password confirmation" >
                <label for="confirmation">New password confirmation</label>
              <span class="hasErrors">{{ errors.first('password confirmation') }}</span>
              </div>
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit"><i class="fa fa-spinner fa-spin" v-show="show"></i> Send</button>
              <div class="custom-control mt-3 mb-3">
              </div>
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
import { passwordReset } from '../../router/router'
export default {
    name:'app-password-verify',
    data() {
        return {
            user: {
                email: '',
                password: '',
                password_confirmation: '',
                token: this.$route.params.token
            },
            messageValidate: '',
            show: false
        }
    },
    methods: {
        updatePassword() {
            this.$validator.validateAll()
                .then(() => {
                    this.$Progress.start()
                    this.show = true
                    post(passwordReset, this.user)
                        .then((res) => {
                            this.$Progress.finish()
                            this.show = false
                            messageValidate = res.data.message

                            this.$nextTick(function () {
                                this.errors.clear()
                            })

                            this.$router.push({ name: 'login' })
                        })
                        .catch((err) => {
                            this.$Progress.fail()
                            this.show = false
                            this.messageValidate = err.response.data.http_status.message

                        })
                })
                .catch(() => {})
        },
        
    }
  }
</script>

<style lang="scss">

</style>
