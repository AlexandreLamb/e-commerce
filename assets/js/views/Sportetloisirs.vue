<template>
    <div> 
         <h1 align="center">Nos articles Sports et Loisirs</h1>
         <div class="container">
        <div class="row" v-for="n in 2" >
        <div  class="col-sm">
         <product-card></product-card>
        </div>
        <div class="col-sm" >
         <product-card></product-card>
        </div>
        <div class="col-sm">
         <product-card></product-card>
        </div>
  </div>
</div>
         </div>
</template>

<script>
    import ProductCard from '../components/ProductCard.vue';
    export default {
        name: 'home',
        components :{
        productCard : ProductCard,
        },
         data () {
          return {
            
          }
          
        },
    }
</script>

