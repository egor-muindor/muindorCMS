import VueRouter from 'vue-router';
import HomePage from './components/HomePage';
import NotFoundPage from './components/NotFoundPage';
import RegisterPage from './components/RegisterPage';
import LoginPage from './components/LoginPage';
import AboutPage from './components/AboutPage';
import SiteSettingsPage from './components/SiteSettingsPage';

import BlogMainPage from './components/blog/MainPage';
import BlogPostPage from './components/blog/PostPage';
import ProfilePage from './components/ProfilePage';

const customRoutes = [
    { path: '/', name: 'HomePage', component: HomePage, meta: { title: 'Главная' } },
    { path: '/register', name: 'RegisterPage', component: RegisterPage, meta: { title: 'Регистрация' } },
    { path: '/login', name: 'LoginPage', component: LoginPage, meta: { title: 'Авторизация' } },
    { path: '/about', name: 'AboutPage', component: AboutPage, meta: { title: 'Обо мне' } },
    { path: '/admin/site-settings', name: 'AdminSiteSettingsPage', component: SiteSettingsPage, meta: { title: 'Редактирование настроек сайта' } },
    { path: '/profile', name: 'ProfilePage', component: ProfilePage, meta: { title: 'Профиль' } }
];

const blogRoutes = [
    { path: '/blog', name: 'Blog.MainPage', component: BlogMainPage, meta: { title: 'Главная блога' } },
    { path: '/blog/:post_id', name: 'Blog.PostPage', component: BlogPostPage, meta: { title: 'Статья' } },
];

const defaultRoutes = [
    { path: '*', name: 'NotFoundPage', component: NotFoundPage, meta: { title: 'Error 404' } }
];

const routes = customRoutes.concat(blogRoutes).concat(defaultRoutes);

export default new VueRouter({
    routes,
    mode: 'history'
});
