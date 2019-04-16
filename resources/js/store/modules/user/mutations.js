import * as types from './mutation-types'
import axios from 'axios'

export default {
    [types.SET_CURRENT_PAGE_USER](state, data) {
        state.currentPageUser = data.currentPageUser
        state.listActivity = data.listActivity
        state.checkLiked = data.checkLiked
        state.inforListActivity = data.inforListActivity
    },
    [types.SET_LOADING](state, loading) {
        state.loading = loading
    },
};