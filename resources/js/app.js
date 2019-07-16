require('./bootstrap');

import App from './components/App';
import VueRouter from 'vue-router';
import router from './router';

router.afterEach((to, from, next) => {
    Vue.nextTick(() => {
        document.title = to.meta.title;
    });
});

window.router = router;

const app = new Vue({
    el: '#app',
    created () {
    },
    router,
    store,
    render: h => h(App)
});
