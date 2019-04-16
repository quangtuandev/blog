import Vue from 'vue'
import Vuex from 'vuex'
import auth from './modules/auth'
import user from './modules/user'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production';

export default new Vuex.Store({
    //Assign the modules to the store
    modules: {
        auth,
        user,

    },
    // #root state
    state: {
        loading: false,
    },
    // #root mutations
    mutations: {
        SET_LOADING(state, loading) {
            state.loading = loading
        },
    },
    // If strict mode should be enabled
    strict: debug,
});