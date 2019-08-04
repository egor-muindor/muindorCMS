export default {
    updateGDPR (state, payload) {
        state.app.GDPR = payload;
    },
    Login (state) {
        state.Auth.name = localStorage.getItem('name');
        state.Auth.email = localStorage.getItem('email');
        state.Auth.admin = localStorage.getItem('admin') === '1';
        state.Auth.api_token = localStorage.getItem('api_token');
        state.Auth.avatar = localStorage.getItem('avatar') !== 'null' ? localStorage.getItem('avatar') : null;
        state.Auth.status =
            (state.Auth.user_id !== null &&
            state.Auth.api_token !== null &&
            state.Auth.name !== null) ? 'auth' : 'guest';
    }
};
