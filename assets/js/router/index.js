import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from '../views/Home.vue';
import Test from '../views/Test.vue';
import Register from '../views/Register.vue';

Vue.use(VueRouter);

export default new VueRouter({
    mode : 'history',
    routes : [
        { path: '/test', component: Test },
        { path: '/register', component : Register},
        { path: '/home' , component : Home }
    ],
});