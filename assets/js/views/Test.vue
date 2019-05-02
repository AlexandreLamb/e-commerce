<template>
    <div>
        <div class="row col">
            <h1>Ventes Flash</h1>
        </div>
        <div class="container">
        
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