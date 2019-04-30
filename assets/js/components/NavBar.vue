<template>
   <div>
  <b-navbar toggleable="lg" type="dark" variant="info">
    <router-link class="navbar-brand" to = "/home">Boomerang</router-link>

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
      </b-navbar-nav>
      
      <!-- Right aligned nav items -->
      <b-navbar-nav class="ml-auto">
        <b-nav-form>
          <b-form-input size="md" class="mr-sm-2" placeholder="Search"></b-form-input>
          <b-button size="md" class="my-2 my-sm-0" type="submit">Search</b-button>
        </b-nav-form>




        <b-nav-form v-if=" !connected ">
          <b-nav-item-dropdown right >
          <!-- Using 'button-content' slot -->
          <template slot="button-content"><em>Login</em></template>
          <b-form-input v-model="input.email" placeholder="Enter your email" type="text"></b-form-input>
          <b-form-input v-model="input.password" placeholder="Enter your password" type="password"></b-form-input>
          <b-button v-on:click="login()" >Login</b-button>
          <router-link class="nav-item" tag="li" to="/register" active-class="active">
                <b-button class="nav-link">Register</b-button>
                    </router-link>
         </b-nav-item-dropdown>
        </b-nav-form>

        <b-nav-item-dropdown v-else right >
          <template  slot="button-content"><em>{{user.username}}</em></template>
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
        }
        },

    }
</script>