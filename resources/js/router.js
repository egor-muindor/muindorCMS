import VueRouter from 'vue-router';
import HomePage from './components/HomePage';
import NotFoundPage from './components/NotFoundPage';
import RegisterPage from './components/RegisterPage';

const routes = [
    { path: '/', name: 'HomePage', component: HomePage, meta: { title: 'Главная' } },
    { path: '/register', name: 'RegisterPage', component: RegisterPage, meta: { title: 'Регистрация' } },
    { path: '*', name: 'NotFoundPage', component: NotFoundPage, meta: { title: 'Error 404' } }
];

export default new VueRouter({
    routes,
    mode: 'history'
});
