export default {
    app: {
        title: 'Egor Muindor Fadeev',
        GDPR: null,
        GDPR_enable: false // отключение GDPR баннера
    },

    Auth: {
        name: null,
        email: null,
        api_token: null,
        avatar: null,
        admin: null,
        status: 'guest'
    },

    info: {
        timeout: 3000,
        show: false,
        text: null
    },

    // auth: ['both', 'guest', 'auth']
    nav: [
        { path: '/', title: 'Главная', icon: 'home', auth: 'both', admin: false },
        { name: 'AboutPage', title: 'Обо мне', icon: 'accessible_forward', auth: 'both', admin: false },
        // { name: 'Blog.MainPage', title: 'Блог', icon: 'book', auth: 'both', admin: false },
        // { name: 'AdminSiteSettingsPage', title: 'Настройки сайта', icon: 'dashboard', auth: 'auth', admin: true }
    ],

    servicesRoutes: [
        { name: 'Service.Timetable', title: 'Поиск пар <br> преподавателя', icon: 'dashboard', auth: 'both', admin: false },
        { name: 'Service.RatingPhyEdu', title: 'Проверка рейтинга <br> по физ-ре', icon: 'rate_review', auth: 'both', admin: false }
    ],

    authRoutes: [
        { name: 'LoginPage', title: 'Авторизация', icon: '', auth: 'guest', admin: false },
        { name: 'RegisterPage', title: 'Регистрация', icon: '', auth: 'guest', admin: false }
    ],

    profileNav: [
        { name: 'ProfilePage', title: 'Профиль', icon: 'face', auth: 'auth', admin: false }
    ]
};
