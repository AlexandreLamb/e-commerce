<template>
    <div>
  <b-card
    :title="product.name"
    :img-src="product.img"
    img-alt="No Image"
    img-top
    tag="article"
    style="max-width: 20rem;"
    class="mb-2"
    v-show=" !onModify"
    img-height="100px"
    img-width="300px"
  >
    <b-card-text>
      {{user.userlastname}}
    </b-card-text>
    <b-card-text> {{user.username}}</b-card-text>
    <b-button-group>
      <b-button href="#" variant="warning">Voir le produit</b-button>
      <b-button v-on:click="deleteProduct" variant="success">Supprimer le vendeur</b-button>
    </b-button-group>
  </b-card>
  <form-add-product v-show="onModify"></form-add-product>
</div>
</template>
<script>
    import { isNullOrUndefined } from 'util';
    import axios from 'axios'; 
    export default {
        name: 'profil',
        components :{
        },
         data () {
          return {
              user : isNullOrUndefined(localStorage.user) ? null : JSON.parse(localStorage.user),
              togglePhone : true,
              toggleAdresse : true,
              toggleCarte : true,
              numcarte : 1234123412341234,
              CryptoCarte : 180, 
              DateCarte : 1212,
          }
        },
        methods: {
          update(){
            var self =this;
axios({
        method: 'post',
        url: '/update/user',
        data: {
          userId : self.user.id,
          userlastname: self.user.userlastname,
          username: self.user.username,
          email: self.user.email,
          telephone: self.user.telephone,
          password: self.user.password,
          pain_password: self.user.pain_password,
          date_naissance : self.user.date_naissance,
          ville: self.user.ville,
          adresse: self.user.adresse,
        }
          }).then(function (response) {
           localStorage.user = JSON.stringify(response.data); 
              window.scrollTo({top : 0 , behavior: 'smooth'})
              self.togglePhone = true;
              self.toggleAdresse = true;
              self.toggleCarte = true;
          })
          .catch(function (error) {
          console.log(error);
        })
          }
        }
    }
</script>