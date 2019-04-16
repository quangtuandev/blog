<template>
<div class="landing-page">
  <div class="container pdt-6">
    <vue-headful
                title="Quên mật khẩu EDUDU - Hệ thống đánh giá chất lượng giảng dạy của giáo viên | edudu.vn"
                description="Hệ thống đánh giá chất lượng giảng dạy của giáo viên"
        />

    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin">
          <div class="card-body">
            <h5 class="card-title text-center">Forgot password </h5>
            <span class="hasErrors"></span>
            <form class="content"  @submit.prevent="resetPassword" autocomplete="off" novalidate>


              <div class="form-label-group">
                <input type="email" 
                data-vv-as="email" 
                name="email" 
                v-validate="'required|email'" 
                v-model="email" id="inputEmail" class="form-control fix-height" placeholder="Email address" >
                <label for="inputEmail">Email address</label>
              <span class="hasErrors">{{ errors.first('email') }}</span>
              <span v-show="messageValidate" class="hasErrors">
                                {{ messageValidate }}
                            </span>
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
import { passwordEmail } from '../../router/router'
export default {
    name:'app-password-reset',
    data: () => ({
        email: '',
        messageValidate: '',
        show: false
    }),
    methods:{
        resetPassword: function() {
            this.$validator.validateAll()
                .then(() => {
                    this.$Progress.start()
                    this.show = true
                    this.messageValidate = ''

                    post(passwordEmail, { email: this.email })
                        .then(res => {
                            this.show = false
                            this.email = ''

                            this.$nextTick(function () {
                                this.$validator.reset()
                                this.errors.clear()
                            })
                            
                            this.$router.push({path:'/sent'})                            
                            this.$Progress.finish()
                        })
                        .catch(err => {
                            this.$Progress.fail()
                            this.show = false
                            const { message, status } = err.response.data.http_status

                            if (!status) {
                                this.messageValidate = message
                            }
                        })
                })
                .catch(() => {})
        }
    }
  }
</script>

<style lang="scss">

</style>
