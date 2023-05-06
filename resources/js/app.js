/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import VueRouter from 'vue-router';

import routes from './routes';
Vue.use(VueRouter);
//import helper user
import User from './Helpers/User';
window.User = User

//import user class
import Notification from './Helpers/Notification';
window.Notification = Notification
    // start sweet alert start
import Swal from 'sweetalert2'
window.Swal = Swal;

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});

window.Toast = Toast;
window.Reload = new Vue();
// start sweet alert end
const app = new Vue({
    el: '#app',
    mode:'history',
    router: new VueRouter(routes)
});
