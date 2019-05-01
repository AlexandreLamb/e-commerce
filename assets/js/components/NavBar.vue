<template>
   <div>
  <b-navbar toggleable="lg" type="dark" variant="info">
    <router-link class="navbar-brand" to = "/home"><h1>Boomerang</h1></router-link>

    <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

    <b-collapse id="nav-collapse" is-nav>
      <b-navbar-nav>
        <b-nav-item-dropdown>
          <!-- Using 'button-content' slot -->
          <template slot="button-content"><em>Catégories</em></template>
          <b-dropdown-item to="/livre">Livres</b-dropdown-item>
          <b-dropdown-item to="/vetement">Vêtements</b-dropdown-item>
          <b-dropdown-item to="/sport">Sport et Loisirs</b-dropdown-item>
          <b-dropdown-item to="/musique">Musiques</b-dropdown-item>
        </b-nav-item-dropdown>
        <router-link class="nav-item" tag="li" to="/test" active-class="active">
                        <a class="nav-link">Ventes flash</a>
                    </router-link>
        <router-link class="nav-item" tag="li" to="/panier" active-class="active">
                        <a class="nav-link">Panier</a>
                    </router-link>
        <router-link v-if="!connected" class="nav-item" tag="li" to="/register" active-class="active">
                        <a class="nav-link"> S'inscrire a l'espace vente</a>
                    </router-link>
        <b-nav-item-dropdown v-else >
          <template  slot="button-content"><em>Espace Vente</em></template>  
          <b-dropdown-item to="/addProduct">Vendre un Produit</b-dropdown-item>
          <b-dropdown-item to="mesVentes">Mes Ventes</b-dropdown-item>
          <b-dropdown-item v-on:click="signOut()"> Sign Out</b-dropdown-item>
        </b-nav-item-dropdown>
        
      </b-navbar-nav>
      
      <!-- Right aligned nav items -->
      <b-navbar-nav class="ml-auto">
      
        <b-nav-form v-if=" !connected ">
          <b-nav-item-dropdown right >
          <!-- Using 'button-content' slot -->
          <template slot="button-content"><em>Login</em></template>
          <b-form-input v-model="input.email" placeholder="Enter your email" type="text" 
          style ="width: 16rem;margin: 0.5rem;font-weight: bold;"></b-form-input>
          <b-form-input v-model="input.password" placeholder="Enter your password" type="password"
          style ="width: 16rem;margin: 0.5rem;font-weight: bold;"></b-form-input>
          
          <div class="btn-group">
          <b-button v-on:click="login()" class="btn btn-dark" style="margin-left:35%;" >Login</b-button>
          <router-link class="nav-item" tag="li" to="/register" active-class="active">
                <b-button class="btn btn-warning" style="margin-left:50%;">Register</b-button>
          </router-link>
          </div>

         </b-nav-item-dropdown>
        </b-nav-form>

        <b-nav-item-dropdown v-else right >
          <template  slot="button-content"><em>{{user.username}} {{user.userlastname}}</em></template>
          <b-dropdown-item to="/profil">Profil</b-dropdown-item>
          <b-dropdown-item href="#">Mes commandes</b-dropdown-item>
          <b-dropdown-item v-on:click="signOut()"> Sign Out</b-dropdown-item>
        </b-nav-item-dropdown>
      </b-navbar-nav>
    </b-collapse>
  </b-navbar>
</div>
</template>

<script>
import axios from 'axios';
import { isNullOrUndefined } from 'util';
    export default {
        name: 'NavBar',
        data () {
          return {
            connected : !isNullOrUndefined(localStorage.user),
            showLoginForm : true,
            input :{
              email:"" ,
              password:"" 
            },
            user : isNullOrUndefined(localStorage.user) ? null : JSON.parse(localStorage.user),
          }
          
        },
        methods : {

          login : function(){
            var self = this;
            axios({
        method: 'post',
        url: '/check/user',
        data: {
          email: self.input.email,
          password: self.input.password,
        }
          }).then(function (response) {
               if(response.data != false){
                self.user = response.data;
                self.connected = true;
                localStorage.user = JSON.stringify(self.user);
               }
          })
          .catch(function (error) {
          console.log(error);
        })
          },
         signOut : function() {
          localStorage.removeItem('user');
          this.user = null;
          this.connected = false;
            this.$router.push('/home');
        }
        },

    }
</script>