require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './routes';
import VueGoodTablePlugin from 'vue-good-table';
// import the styles
import 'vue-good-table/dist/vue-good-table.css'

Vue.use(VueRouter);
Vue.use(VueGoodTablePlugin);

let app = new Vue({
    el: '#app',

    router: new VueRouter(routes),

    data: {
        init: false,
    }
});
