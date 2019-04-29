<template>
    <div>
        <div class="row col">
            <h1>SecondPage</h1>
        </div>

        <div class="row col">
            <p>This is the Seconde PAge of our Vue.js application.</p>
        </div>
        <div class="container">
        <div class="row" v-for="n in 3" >
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