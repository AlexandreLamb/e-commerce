<template>
    <div>
  <b-card
    :title="product.productName"
    img-src="https://picsum.photos/600/300/?image=25"
    img-alt="Image"
    img-top
    tag="article"
    style="max-width: 20rem;"
    class="mb-2"
  >
    <b-card-text>
      {{product.productDescription}}
    </b-card-text>
    <b-card-text> {{product.price}} Euros</b-card-text>
    <b-button-group>
      <b-button href="#" variant="warning">Voir le produit</b-button>
      <b-button href="#" variant="success">Ajouter au Panier</b-button>
    </b-button-group>
    
  </b-card>
</div>
</template>
<script>
  export default {
    props: {
      product : {
        type : Object,
        default: {
          productName: "Pas de nom de produit",
          productDescription: "Pas de description",
          price : 0,
        }
          }
      }

    ,
    data() {
      return {
      
      }
    },
    methods: {
     
    }
  }
</script>