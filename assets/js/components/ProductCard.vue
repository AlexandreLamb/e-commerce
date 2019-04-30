<template>
    <div>
  <b-card
    :title="product.name"
    :img-src="product.img"
    img-alt="No Image"
    img-top
    tag="article"
    style="max-width: 20rem;"
    heigth="200"
    class="mb-2"
  >
    <b-card-text>
      {{product.description}}
    </b-card-text>
    <b-card-text> {{product.price}} Euros</b-card-text>
    <b-button-group>
      <b-button v-on:click="toggleVisibility()" variant="warning">Voir le produit</b-button>
      <b-button v-on:click="addPannier()" variant="success">Ajouter au Panier</b-button>
    </b-button-group>
    
  </b-card>
</div>
</template>
<script>
      import { isNullOrUndefined } from 'util';
      import axios from 'axios';
  export default {
    props: {
      product : {
        type : Object,
        default() { 
          return{   name : "Pas de nom de produit",
                    description : "Pas de description",
                    price : 0,
                    categorie : "none"
          }
        }
          }
      }

    ,
    data() {
      return {
         user : isNullOrUndefined(localStorage.user) ? null : JSON.parse(localStorage.user),
         visibility : false
      }
    },
    methods: {
      addPannier(){
        var self = this;
        axios({
        method: 'post',
        url: '/add/product/panier',
        data: {
          userId: self.user.id,
          productId: self.product.id,
        }
          }).then(function (response) {
            console.log(response.data);
          })
          .catch(function (error) {
          console.log(error);
        })
      },
      toggleVisibility(){
        var self = this;
        self.$emit('cliked' , self.product);
                self.visibility = !self.visibility
      }
    }
  }
</script>