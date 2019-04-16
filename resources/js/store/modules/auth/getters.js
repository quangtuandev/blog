/* ============
 * Getters for the account module
 * ============
 *
 * The getters that are available on the
 * account module.
 */
import state from './state';
export default {
    user(state) {
        return state.user;
    },
};