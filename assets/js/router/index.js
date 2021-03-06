import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from '../views/Home.vue';
import Test from '../views/Test.vue';
import Register from '../views/Register.vue';
import AddProduct from '../views/AddProduct.vue';
import Panier from '../views/Panier.vue';
import Livre from '../views/Livre.vue';
import Vetement from '../views/Vetement.vue';
import Sportetloisirs from '../views/Sportetloisirs.vue';
import Musique from '../views/Musique.vue';
import Profil from '../views/Profil.vue';
import MesVentes from '../views/MesVentes.vue';
import Admin from '../views/Admin.vue';
import Paiment from '../views/Paiment.vue';


Vue.use(VueRouter);

export default new VueRouter({
    mode : 'history',
    routes : [
        { path: '/test', component: Test },
        { path: '/register', component : Register},
        { path: '/home' , component : Home },
        { path: '/addProduct' , component : AddProduct},
        { path: '/panier' , component : Panier},
        { path: '/livre' , component : Livre},
        { path: '/vetement' , component : Vetement},
        { path: '/sport' , component : Sportetloisirs},
        { path: '/musique' , component : Musique},
        { path: '/profil' , component : Profil},
        { path: '/mesVentes' , component : MesVentes},
        { path: '/addProduct' , component : AddProduct},
        { path: '/admin' , component : Admin},
        { path: '/paiment', name : 'paiment',  component:Paiment }
         ]
});