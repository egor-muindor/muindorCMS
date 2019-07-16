import ExampleComponent from './components/ExampleComponent';
import VueRouter from 'vue-router';

const routes = [
    { path: '/', name: 'HomePage', component: ExampleComponent, meta: { title: 'Home page' } }
];

export default new VueRouter({
    routes,
    mode: 'history'
});
