// Here is API router from server to avoid hardcode while development is

export const getUser = 'user'
export const handleLogin = 'login'
export const logout = 'logout'
export const register = 'register'
export const passwordEmail = 'password/email'
export const passwordReset = 'password/reset'
export const getReviewLastest = 'review/lastest'
export const postPost = 'post/new'
export const postReviewTeacher = 'review/new'
export const uploadFile = 'file/upload'
export const detailPost = 'post/show/'
export const detailUser = 'user/show/'
export const getReview = 'review/show/'
export const getAllCategories = 'category/show/'
export const tags = 'tag'

export default {
    getUser,
    handleLogin,
    logout,
    register,
    passwordEmail,
    passwordReset,
    getReviewLastest,
    postPost,
    postReviewTeacher,
    uploadFile,
    detailPost,
    detailUser,
    getReview,
    getAllCategories,
    tags
}