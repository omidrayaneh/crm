/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


window.Vue = require('vue');
Vue.component('pagination', require('laravel-vue-pagination'));
import VuePersianDatetimePicker from 'vue-persian-datetime-picker';
Vue.component('date-picker', VuePersianDatetimePicker);
import Swal from 'sweetalert2'
// import Vue from 'vue'
// import VueRouter from 'vue-router'
//
//
// import Navbar from "./components/Navbar";
// import InfoComponent from "./components/InfoComponent";
 //import axios from 'axios'
//
// Vue.use(VueRouter)

window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('home', require('./components/Home.vue').default);
Vue.component('date-time', require('./components/Date.vue').default);
Vue.component('customer', require('./components/CustomerComponent.vue').default);
Vue.component('vendor', require('./components/VendorComponent.vue').default);
Vue.component('product', require('./components/ProductComponent.vue').default);
Vue.component('support', require('./components/SupportComponent.vue').default);
Vue.component('task', require('./components/TaskComponent.vue').default);
Vue.component('event', require('./components/EventComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
