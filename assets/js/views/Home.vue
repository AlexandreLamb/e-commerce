<template>
    <div>   
        <carousel></carousel>
        <h1> Nos meilleures ventes </h1>
        <div class="container">
  <div class="row" v-for="n in 1">
        <div  class="col-sm">
         <product-card></product-card>
        </div>
        <div  class="col-sm">
         <product-card></product-card>
        </div>
        <div  class="col-sm">
         <product-card></product-card>
        </div>
        <div  class="col-sm">
         <product-card></product-card>
        </div>
  </div>
</div>
    </div>
    
</template>

<script>
    import Carousel from '../components/Carousel.vue';
    import ProductCard from '../components/ProductCard.vue';
    export default {
        name: 'home',
        components :{
        productCard : ProductCard,
        carousel : Carousel,
        },
         data () {
          return {
            
          }
          
        },
    }
</script>