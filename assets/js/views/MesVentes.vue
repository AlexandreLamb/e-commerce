<template>
    <div>   
        <h1> Mes ventes actuelles </h1>
        <b-row>
            <product-cardV v-for="product in products" :key="product.id" :product="product" class="col-sm-6 col-md-4 "></product-cardV>
        </b-row>
    </div>
    
</template>

<script>
    import Carousel from '../components/Carousel.vue';
    import ProductCardV from '../components/ProductCardV.vue';
    import axios from 'axios';
    import { isNullOrUndefined } from 'util';


    export default {
        name: 'home',
        components :{
        productCardV : ProductCardV,
        },
         data () {
          return {
            products : [],
            user : isNullOrUndefined(localStorage.user) ? null : JSON.parse(localStorage.user),

          }
          
        },
        methods :{
            getProducts(){
                self = this;
                axios({
            method: 'get',
            url: '/get/vente/user/'+self.user.id,
          }).then(function (response) {
            self.products = response.data; 

          })
          .catch(function (error) {
          console.log(error);
        })
            }
        },
        created: function(){
            this.getProducts()
        },
        mounted: function(){
            this.getProducts()
        }
    }
</script>