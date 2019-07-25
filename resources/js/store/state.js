export default {
    app: {
        title: 'Egor Muindor Fadeev',
        GDPR: null,
        GDPR_enable: false // отключение GDPR баннера
    },

    Auth: {
        name: null,
        api_token: null,
        status: 'guest'
    },

    info: {
        timeout: 3000,
        show: false,
        text: null
    },

    nav: [
        { path: '/', title: 'Главная', icon: 'home', auth: 'both', admin: false },
        { name: 'AboutPage', title: 'Обо мне', icon: 'accessible_forward', auth: 'both', admin: false },
        { name: 'Blog.MainPage', title: 'Блог', icon: 'book', auth: 'both', admin: false },
        { name: 'AdminSiteSettingsPage', title: 'Настройки сайта', icon: 'dashboard', auth: 'auth', admin: true },
    ],

    authRoutes: [
        { name: 'LoginPage', title: 'Авторизация', icon: '', auth: 'guest', admin: false },
        { name: 'RegisterPage', title: 'Регистрация', icon: '', auth: 'guest', admin: false },
    ],

    profileNav: [

    ]
};
