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
        { path: '/', title: 'Главная', auth: 'both', icon: 'home' },
        // { path: '/page2', title: 'Example', auth: 'both', icon: 'accessible_forward' },
        // { path: '/qweqwe', title: 'Not found page', auth: 'both', icon: 'accessible_forward' }
    ],

    authRoutes: [
        { name: 'LoginPage', title: 'Авторизация', auth: 'guest', icon: '' },
        { name: 'RegisterPage', title: 'Регистрация', auth: 'guest', icon: '' },
        // { path: '/qweqwe', title: 'Not found page', auth: 'both', icon: 'accessible_forward' }
    ],

    profileNav: [
        // { name: 'LoginPage', title: 'Авторизация', auth: 'guest', icon: '' },
    ]
};
