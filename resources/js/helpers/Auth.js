import axios from 'axios';

export default {
    init () {
        store.commit('Login');
        if (store.state.Auth.api_token) {
            axios.defaults.headers.common['Authorization'] =
                'Bearer ' + store.state.Auth.api_token;
        }
    },

    verify () {
        if (store.state.Auth.status === 'auth') {
            axios.post('/api/user/verify').then(response => {
                this.login(response.data.user);
            }).catch(error => {
                if (error.response.status === 401) {
                    this.logout();
                    router.push('/login');
                }
                console.error(error.response);
            });
        }
    },

    login (data) {
        localStorage.setItem('api_token', data.api_token);
        localStorage.setItem('name', data.name);
        localStorage.setItem('email', data.email);
        localStorage.setItem('admin', data.admin);
        localStorage.setItem('avatar', data.avatar);

        this.init();
    },

    logout () {
        localStorage.removeItem('api_token');
        localStorage.removeItem('name');
        localStorage.removeItem('email');
        localStorage.removeItem('admin');
        localStorage.removeItem('avatar');

        this.init();
    },

    check () {
        if (store.state.Auth.status === 'guest') {
            router.push('/login');
        }
    },

    checkAdmin () {
        this.check();
        if (!store.state.Auth.admin) {
            router.push('/');
        }
    },

    checkAlready () {
        if (store.state.Auth.status === 'auth') {
            router.push('/');
        }
    }
};
