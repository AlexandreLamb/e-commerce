require('../css/app.css');

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

const $ = require('jquery');

import BootstrapVue from 'bootstrap-vue'
import Vue from 'vue';
import router from './router'


import App from './App.vue';

Vue.use(BootstrapVue)


new Vue({
    template: '<App/>',
    components: { App },
    router
}).$mount('#app');

