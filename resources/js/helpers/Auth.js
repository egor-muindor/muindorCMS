import axios from 'axios';

export default {
    init () {
        store.commit('Login');
        if (store.state.Auth.api_token) {
            axios.defaults.headers.common['Authorization'] =
                'Bearer ' + store.state.Auth.api_token;
        }
    },

    login (data) {
        localStorage.setItem('api_token', data.api_token);
        localStorage.setItem('name', data.name);
        localStorage.setItem('admin', data.admin);

        this.init();
    },

    logout () {
        localStorage.removeItem('api_token');
        localStorage.removeItem('name');

        this.init();
    },

    check () {
        if (store.state.Auth.status === 'guest') {
            router.push('/login');
        }
    },

    checkAlready () {
        if (store.state.Auth.status === 'auth') {
            router.push('/');
        }
    }
};
