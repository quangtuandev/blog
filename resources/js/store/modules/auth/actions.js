/* ============
 * Actions for the account module
 * ============
 *
 * The actions that are available on the
 * account module.
 */

import * as types from './mutation-types'
import * as routes from '../../../router/router'
import { post, get } from '../../../helpers/api'

export const check = ({ commit }) => {
    commit(types.CHECK);
};

export const login = ({ commit }, data) => {
    commit('SET_LOADING', true, { root: true })

    return new Promise((resolve, reject) => {
        post(routes.handleLogin, data)
            .then(res => {
                commit(types.LOGIN, res.data)
                commit('SET_LOADING', false, { root: true });
                resolve(res.data.http_status.status)
            })
            .catch(err => {
                commit('SET_LOADING', false, { root: true });
                console.log(err)
                reject(err)
            })
    })
};

export const logout = ({ commit }) => {
    commit('SET_LOADING', false, { root: true });
    window.Laravel.url_after_login = null
    commit(types.LOGOUT);
};

export const setUser = ({ commit }, user) => {
    commit(types.SET_USER, user);
};


export default {
    check,
    login,
    logout,
    setUser,
};