import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from '../views/Home.vue';
import Test from '../views/Test.vue';

Vue.use(VueRouter);

export default new VueRouter({
    mode : 'history',
    routes : [
        { path: '/Test', component: Test },
        { path: '*' , component : Home }
    ],
});