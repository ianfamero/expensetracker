
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
import router from './router';

import Buefy from 'buefy';
import 'buefy/dist/buefy.css';

window.moment = require('moment');
require('moment/locale/en-gb');

Vue.use(VueRouter);
Vue.use(Buefy);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('user-login', require('./components/Login.vue'));
Vue.component('main-header', require('./components/common/Header.vue'));
Vue.component('add-expense-modal', require('./components/tracker/AddExpenseModal.vue'));
Vue.component('add-fund-modal', require('./components/funds/AddFundModal.vue'));
Vue.component('transfer-fund-modal', require('./components/funds/TransferFundModal.vue'));

const app = new Vue({
    el: '#app',
    router,
    methods: {
      showToast: function(type, message) {
        this.$toast.open({
          duration: 4000,
          message: message,
          position: 'is-top',
          type: type
        });
      },
      validator: function(val) {
        if(val != null) {
          return true;
        } else { 
          return false; 
        }
      },
    }
});
