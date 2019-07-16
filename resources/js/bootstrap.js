import VueRouter from 'vue-router';

window.Vue = require('vue');
Vue.use(VueRouter);
window.VueRouter = VueRouter;

import Vuex from 'vuex';
import state from './store/state';
import mutations from './store/mutations';
import actions from './store/actions';

const store = new Vuex.Store({
    state,
    getters: {},
    mutations,
    actions
});
window.store = store;

window._ = require('lodash');
window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
