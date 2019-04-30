<template>
    <div> 
        <h1 align="center">Nos livres</h1>
         <div class="container">
        <b-row>
            <product-card v-for="vetement in vetements" :key="vetement.id" :product="vetement" class="col-sm-6 col-md-4 col-lg-3"></product-card>
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
            vetements : []
          }
          
        },
        methods :{
            getVetements : function(){
                var self = this;
                axios({
                    method: 'get',
                    url: '/get/products/vetements',
                }).then(function (response) {
                self.vetements = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                })
            }
        },
        mounted : function(){
            this.getVetements();
        }
    }
</script>

