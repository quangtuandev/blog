<template>
<div class="landing-page">
  <div class="container pdt-6">
    <vue-headful
                title="Đăng nhập EDUDU - Hệ thống đánh giá chất lượng giảng dạy của giáo viên | edudu.vn"
                description="Hệ thống đánh giá chất lượng giảng dạy của giáo viên"
        />
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin">
          <div class="card-body">
            <h5 class="card-title text-center">Sign In</h5>
            
            <form class="form-signin" @submit.prevent="handlelogin" novalidate>
              <div class="form-group" v-if="true">
                  <p class="hasErrors">
                    {{ message }}
                  </p>
              </div>
              <div class="form-label-group">
                <input type="email" data-vv-as="email" name="email" v-validate="'required|email'"  v-model="user.email" id="inputEmail" class="form-control fix-height" placeholder="Email address" required autofocus>
                <label for="inputEmail">Email address</label>
              </div>
              <!-- <span class="hasErrors">{{ errors.first('email') }}</span> -->

              <div class="form-label-group">
                <input type="password" data-vv-as="password" name="password" v-validate="'required|min:6'"  v-model="user.password" id="inputPassword" class="form-control fix-height" placeholder="Password" required>
                <label for="inputPassword">Password</label>
              </div>
              <!-- <span class="hasErrors">{{ errors.first('password') }}</span> -->

              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign in</button>
              <!-- <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="customCheck1">
                <label class="custom-control-label" for="customCheck1">Remember password</label>
              </div> -->
              <div class="custom-control mt-3 mb-3">
                <router-link to="password/reset">Forgot your password ?</router-link>
              </div>
              <hr class="my-4">

              <button class="btn btn-lg btn-google btn-block text-uppercase"  @click.prevent="redirect('google')"><i class="fa fa-google mr-2"></i> Sign in with Google</button>
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
import { mapState, mapActions } from 'vuex'
export default {
    data: () => ({
        user: {
            email: '',
            password: ''
        },
        message: ''
    }),
    computed: {
        ...mapState({
            loading: state => state.loading,
        }),
        ...mapState('auth', {
            authenticated: state => state.authenticated
        })
    },
    methods: {
        ...mapActions('auth', [
            'login',
        ]),
        handlelogin() {
            this.$validator.validateAll().then(() => {
                this.$Progress.start()
                this.login(this.user)
                    .then(registered => {
                        if (registered) {
                            this.$Progress.finish()
                            if (localStorage.getItem('redirect_after_login')){
                                this.$router.push(localStorage.getItem('redirect_after_login'))
                                localStorage.removeItem('redirect_after_login')
                            } else {
                                this.$router.push("/")
                            }
                        }
                    })
                    .catch(err => {
                        this.$Progress.fail()
                        this.message = this.$i18n.t('messages.login_fail')
                        console.log(message)
                    })
            })
        },
        redirect(provider) {
            window.location = `${window.Laravel.url}/redirect/${provider}`
        }
    }
}
    
</script>

<style>
</style>
