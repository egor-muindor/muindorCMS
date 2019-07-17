import VueRouter from 'vue-router';

window.Vue = require('vue');
Vue.use(VueRouter);
window.VueRouter = VueRouter;
import VueCookie from 'vue-cookie';
Vue.use(VueCookie);
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
