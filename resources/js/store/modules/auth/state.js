import { getLocalUser } from '../../../helpers/auth'

const user = getLocalUser();
export default {
    authenticated: false,
    user: user,
    checkAdmin: false,
}