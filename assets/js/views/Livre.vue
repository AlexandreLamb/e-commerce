<template>
    <div> 
        <h1 align="center">Nos livres</h1>
         <div class="container">
        <b-row>
            <product-card v-for="livre in livres" :key="livre.id" :product="livre" class="col-sm-6 col-md-4 col-lg-3"></product-card>
        </b-row>
        </div>
  </div>
         
</template>

<script>
    import ProductCard from '../components/ProductCard.vue';
    import axios from 'axios';
    export default {
        components :{
        productCard : ProductCard,
        },
         data () {
          return {
            livres : []
          }
          
        },
        methods :{
            getLivres : function(){
                var self = this;
                axios({
                    method: 'get',
                    url: '/get/products/livres',
                }).then(function (response) {
                self.livres = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                })
            }
        },
        mounted : function(){
            this.getLivres();
        }
    }
</script>

