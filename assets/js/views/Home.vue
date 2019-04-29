<template>
    <div>   
        <carousel></carousel>
        <h1> Nos meilleures ventes </h1>
        <b-row>
            <product-card v-for="product in products" :key="product.id" :product="product" class="col-sm-6 col-md-4 col-lg-3"></product-card>
        </b-row>
    </div>
    
</template>

<script>
    import Carousel from '../components/Carousel.vue';
    import ProductCard from '../components/ProductCard.vue';
    import axios from 'axios';

    export default {
        name: 'home',
        components :{
        productCard : ProductCard,
        carousel : Carousel,
        },
         data () {
          return {
            products : []
          }
          
        },
        methods :{
            getProducts(){
                self = this;
                axios({
            method: 'get',
            url: '/get/products',
          }).then(function (response) {
            console.log(response.data);
            self.products = response.data; 

          })
          .catch(function (error) {
          console.log(error);
        })
            }
        },
        created: function(){
            this.getProducts()
        }
    }
</script>