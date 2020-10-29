require('./bootstrap');

window.Vue = require('vue');

import VueRouter       from 'vue-router';
import Index  from './components/menu/Index.vue';
import Create from './components/menu/Create.vue';

window.Vue.use(VueRouter);
window.events = new Vue();

const routes = [
    {
        path: '/',
        components: {
            index: Index
        }
    },
    {path: '/create', component: Create, name: 'create'},
]

const router = new VueRouter({routes})

const app = new Vue({
    router,
}).$mount('#app')
