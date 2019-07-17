import GDPRBannerComponent from './components/GDPRBannerComponent';

require('./bootstrap');
import vuetify from './plugins/vuetify'
import App from './components/App';
import router from './router';

router.afterEach((to, from, next) => {
    Vue.nextTick(() => {
        document.title = to.meta.title;
    });
});
Vue.component('gdpr-banner', GDPRBannerComponent);
window.router = router;

const app = new Vue({
    el: '#app',
    created () {
    },
    router,
    store,
    vuetify,
    render: h => h(App)
});
