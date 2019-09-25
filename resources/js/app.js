require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import VueAxios from 'vue-axios';
import axios from 'axios';
axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': window.csrf_token
};
Vue.use(VueAxios, axios);

import money from 'v-money';
Vue.use(money, {precision: 4});

import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css'
Vue.use(Vuetify);

import VueCookie from 'vue-cookies';
Vue.use(VueCookie);

import 'material-design-icons-iconfont/dist/material-design-icons.css';
import 'bootstrap-css-only/css/bootstrap.min.css';
import 'mdbvue/build/css/mdb.css';
import App from './App.vue';

import store from '../assets/js/store/store.js';

import IndexComponent from './pages/IndexComponent.vue';
import LoginComponent from './pages/LoginComponent.vue';
import RegisterComponent from './pages/RegisterComponent.vue';
import ProfileComponent from './pages/ProfileComponent.vue';
import CreateComponent from './pages/CreateComponent.vue';
import ProductComponent from './pages/ProductComponent.vue';
import CheckoutComponent from './pages/CheckoutComponent.vue';
import SuccessComponent from './pages/SuccessComponent.vue';
import PageNotFoundComponent from './pages/PageNotFoundComponent.vue';
import DashboardComponent from './pages/DashboardComponent.vue';
import WithdrawComponent from './pages/WithdrawComponent.vue';

const routes = [
    {
        name: 'home',
        path: '/',
        component: IndexComponent
    },
    {
        name: 'register',
        path: '/register',
        component: RegisterComponent
    },
    {
        name: 'login',
        path: '/login',
        component: LoginComponent
    },
    {
        name: 'dashboard',
        path: '/dashboard',
        component: DashboardComponent
    },
    {
        name: 'withdraw',
        path: '/withdraw',
        component: WithdrawComponent
    },
    {
        name: '404',
        path: '/404',
        component: PageNotFoundComponent
    },
    {
        name: 'profile',
        path: '/:id',
        component: ProfileComponent
    },
    {
        name: 'create',
        path: '/:id/createapparel',
        component: CreateComponent
    },
    {
        name: 'buy',
        path: '/:username/:id',
        component: ProductComponent
    },
    {
        name: 'checkout',
        path: '/checkout/:username/:id/:color/:size',
        component: CheckoutComponent
    },
    {
        name: 'success',
        path: '/order/success/:id/:userid/:size/:color',
        component: SuccessComponent
    }
];

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

new Vue(Vue.util.extend({
    el: '#app',
    router,
    store
}, App));
