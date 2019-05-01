<template>
    <div v-show=" !isDelete ">
        
<b-card
    :title="product.name"
    :img-src="product.file"
    img-alt="No Image"
    img-top
    tag="article"
    style="max-width: 20rem;"
    class="mb-2"
    img-height="100px"
    img-width="300px"
  >
  
    <b-card-text> {{product.price}} Euros</b-card-text>
         <b-button-group> 
          <b-button  variant="warning">Voir le produit</b-button>
          <b-button v-on:click="deleteProduct()" variant="warning">Supprimer le produit</b-button>
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
         visibility : false,
         isDelete : false
      }
    },
    methods: {
      deleteProduct(){
          var self = this;
          console.log('zfe')
        self.$emit('cliked' , self.product);
        //this.isDelete = ! this.isDelete;
      },
      toggleVisibility(){
        var self = this;
        self.$emit('cliked' , self.product);
                self.visibility = !self.visibility
      }
    }
  }
</script>