import VueRouter from 'vue-router';
import HomePage from './components/HomePage';
import NotFoundPage from './components/NotFoundPage';

const routes = [
    { path: '/', name: 'HomePage', component: HomePage, meta: { title: 'Главная' } },
    { path: '*', name: 'NotFoundPage', component: NotFoundPage, meta: { title: 'Error 404' } }
];

export default new VueRouter({
    routes,
    mode: 'history'
});
