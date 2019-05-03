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
      {{product.description}}
    </b-card-text>
    <b-card-text> {{product.price}} Euros</b-card-text>
    <b-card-text> Nombre restant : {{product.quantite}}</b-card-text>

    <b-button-group>
      <b-button href="#" variant="warning">Voir le produit</b-button>
      <b-button v-on:click="onModify = !onModify" variant="info">Modifier le produit</b-button>
      <b-button v-on:click="deleteProduct" variant="success">Supprimer le produit</b-button>
    </b-button-group>
  </b-card>
  <form-add-product v-show="onModify"></form-add-product>
</div>
</template>
<script>
  import FormAddProduct from '../components/FormAddProduct.vue'
   export default {
     
    components:{
      formAddProduct : FormAddProduct,
    },
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
        onModify : false,
      }
    },
    methods: {
     deleteProduct(){
          var self = this;
        self.$emit('cliked' , self.product);
      },
    }
  }
</script>