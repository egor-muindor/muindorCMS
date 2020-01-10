import Vue from 'vue';
import ru from 'vuetify/es5/locale/ru';
import Vuetify from 'vuetify/lib';

Vue.use(Vuetify);

export default new Vuetify({
    lang: {
        locales: { ru },
        current: 'ru'
    },
    icons: {
        iconfont: 'mdiSvg'
    }
});
