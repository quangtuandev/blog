require('./bootstrap');

import Vue from 'vue'
import VueI18n from 'vue-i18n'
import store from './store'
import messages from './locale'
import routes from './router'
import vueHeadful from 'vue-headful';
import VeeValidate, { Validator } from 'vee-validate'
import rules from './validation'
import { config, dictionary } from './validation/config'
import { topProgressBar } from './config'
import makeRouter from './router/middleware'
import VueProgressBar from 'vue-progressbar'
import app from './components/layouts/App'

import Quill from 'quill';
import VueQuillEditor from 'vue-quill-editor'
import { ImageImport } from './helpers/quill-editor/ImageImport'
import { ImageResize } from './helpers/quill-editor/ImageResize'

Quill.register('modules/imageImport', ImageImport)
Quill.register('modules/imageResize', ImageResize)
Vue.use(VueQuillEditor)
Vue.use(VueI18n)
Vue.component('vue-headful', vueHeadful);
Vue.use(VueProgressBar, topProgressBar)
Vue.use(VeeValidate, config)
for (let rule in rules) {
    Validator.extend(rule, rules[rule])
}

Validator.localize(dictionary);
let lang = localStorage.getItem('locale') || window.Laravel.locale

const i18n = new VueI18n({
    locale: lang,
    fallbackLocale: window.Laravel.fallbackLocale,
    messages
})
const router = makeRouter(routes)

window.moment.locale(lang)
var vm = new Vue({
    router,
    store,
    i18n,
    el: '#app',
    render: h => h(app)
});