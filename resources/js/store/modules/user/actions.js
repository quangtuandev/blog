/* ============
 * Actions for the account module
 * ============
 *
 * The actions that are available on the
 * account module.
 */
import * as types from './mutation-types';
import {get } from '../../../helpers/api'


export const loadMore = ({ commit }, data) => {
    if (data.infoPaginate.to < data.infoPaginate.total) {
        commit(types.SET_LOADING, true);
        return new Promise((resolve, reject) => {
            get(`user/${data.id}?page=${data.infoPaginate.current_page + 1}`)
                .then(res => {
                    commit(types.SET_LOADING, false)
                    resolve(res.data.data.currentPageUser)
                })
                .catch(err => {
                    commit(types.SET_LOADING, false);
                    reject(err)
                })
        })
    }
};
export default {
    loadMore
};