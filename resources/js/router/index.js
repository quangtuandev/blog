import { authGuard, guestGuard } from './middleware'
import Vue from 'vue'
import VueRouter from 'vue-router'


import Login from '../components/auth/Login'
import Register from '../components/auth/Register'
import PasswordReset from '../components/auth/PasswordReset'
import PasswordVerify from '../components/auth/PasswordVerify'
import NotFound from '../components/errors/404'
import HomePage from '../components/home/home'
import SentEmail from '../components/auth/SentEmail'
import NewPost from '../components/post/newPost'
import DetailPost from '../components/post/detailPost'
import ProfileUser from '../components/user/profile'
import SearchPage from '../components/common/search'
import WriteReviewTeacher from '../components/review/newReviewTeacher'
import DetailReviews from '../components/review/detailReviews'
import EditReview from '../components/review/editReviewTeacher'

const router = [
    { path: '/', component: HomePage, name: 'homepage' },
    { path: '/search/:keyword', component: SearchPage, name: 'search' },
    { path: '/user-profile/:id', component: ProfileUser, name: 'profile_user' },
    { path: '/detail-post/:id', component: DetailPost, name: 'detail_post' },
    { path: '/reviews/:id/edit', component: EditReview, name: 'edit_review' },
    { path: '/reviews/:id', component: DetailReviews, name: 'success_created_review' },

    // only auth can visit here
    ...authGuard([
        { path: '/new-post', component: NewPost, name: 'newpost' },
        { path: '/write-review/:id', component: WriteReviewTeacher, name: 'create_review_teacher' },
    ]),

    // only guest can visit here
    ...guestGuard([
        { path: '/register', component: Register, name: 'register' },
        { path: '/login', component: Login, name: 'login' },
        { path: '/password/reset', component: PasswordReset },
        { path: '/password/reset/:token', component: PasswordVerify },
        { path: '/sent', component: SentEmail },

    ]),
    { path: '*', component: NotFound, name: 'not_found' },

]

Vue.use(VueRouter)

export default router