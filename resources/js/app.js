/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';

window.Vue.use(VueRouter);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));
import Dashboard from './components/meetings/Dashboard.vue';
import App from './components/App.vue';
import MeetingsDetail from './components/meetings/MeetingsDetail.vue';
import User from './components/User.vue';
import Friends from './components/Friends.vue';


import PassportClients from './components/passport/Clients.vue';
import PassportAuthorizedClients from './components/passport/AuthorizedClients.vue';
import PassportPersonalAccessTokens from './components/passport/PersonalAccessTokens.vue';

const routes = [
    {
        path: '/',
        component: Dashboard,
        name: 'dashboard'

    },
    {   path: '/meetings/detail-:id',
        component: MeetingsDetail,
        name: 'meetingDetail'
    },
    {
        path: '/user',
        component: User,
        name: 'user',
    },
    {
        path: '/friends',
        component: Friends,
        name: 'friends',
    },
    {   path: '/clients',
        component: PassportClients,
        name: 'passportClients'
    },
    {   path: '/authorizedclients',
        component: PassportAuthorizedClients,
        name: 'passportAuthorizedClients'
    },
    {   path: '/personalaccesstokens',
        component: PassportPersonalAccessTokens,
        name: 'passportPersonalAccessTokens'
    },
];
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//GLOBAL DATA
Vue.prototype.$userId = document.querySelector("meta[name='user-id']").getAttribute('content');
Vue.prototype.$headers = {
                'Accept' : 'application/json',
                'Authorization' : 'Bearer ' + document.querySelector("meta[name='user-token']").getAttribute('content'),
                }
const router = new VueRouter({ routes })
const app = new Vue({
    el: '#app-content',
    router,
    components: {App},
    template: '<App/>',
    })
