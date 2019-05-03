<template>
    <div>
        <div class="row col">
            <h1>Paiment</h1>
        </div>
        <div class="container">
            <b-card>
      <p class="card-text">Recapitulatif de vos achat : </p>
      <b-list-group>
          <b-row>
          <b-col> Nom du produit </b-col>  <b-col> Prix </b-col>  <b-col> Quantite</b-col> 
          </b-row> 
        <b-list-group-item v-for="product in $route.params.products" :key="product.id">         
          <b-row>
            <b-col> {{product.name}} </b-col> <b-col> {{product.price}}</b-col> <b-col>{{product.quantiteProduct}}</b-col>
          </b-row>  
        </b-list-group-item>
        <b-row>
        <b-col> total a payer : {{$route.params.total}}</b-col>
        <b-col> <b-button v-b-toggle.collapse-1> Payer</b-button></b-col>
        </b-row>
    </b-list-group>
    </b-card>
    <b-collapse id="collapse-1" class="mt-2">
    <b-card >
        <b-card-title>
            Vos Informations
        </b-card-title>
     <b-list-group flush>
      <b-list-group-item>{{user.username}} {{user.lastusername}}</b-list-group-item>
      <b-list-group-item>Adressse facturation : {{user.adresse}} {{user.ville}} {{user.codePostale}} {{user.pays}}</b-list-group-item>
      <b-list-group-item>Telephone : {{user.telephone}}</b-list-group-item>
      <b-list-group-item>
          <b-card>
              <b-list-group flush>
                  <b-list-group-item>Numero de carte : {{user.numero}}</b-list-group-item>
                  <b-list-group-item>Date de fin de validité {{user.dateValidite}}</b-list-group-item>
                  <b-list-group-item>Crypto : {{user.crypto}}</b-list-group-item>
              </b-list-group>
          </b-card>

      </b-list-group-item>
      <b-button v-on:click="payer()">Valider et payer</b-button>
    </b-list-group>
       
    </b-card>
  </b-collapse>
         
    </div>
    </div>
    
</template>

<script>
    import ProductCard from '../components/ProductCard.vue';
    import { isNullOrUndefined } from 'util';
    import axios from 'axios';

    export default {
        components :{
        productCard : ProductCard,
        },
         data () {
          return {
              showPaiment:false,
              user : isNullOrUndefined(localStorage.user) ? null : JSON.parse(localStorage.user),
 
          }
          
        },
        methods:{
            payer(){
 var self = this;
        self.onLoad=true;
        axios({
        method: 'get',
        url: '/post/payer/user/'+self.user.id,
        
          }).then(function (response) {
            console.log(response.data)
            self.$router.push('/home');
            
          })
          .catch(function (error) {
          console.log(error);
        })
            }
        }
    }
</script>