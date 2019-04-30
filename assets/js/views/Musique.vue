<template>
    <div> 
        <h1 align="center">Nos Musiques</h1>
         <div class="container">
        <b-row>
            <product-card v-for="musique in musiques" :key="musique.id" :product="musique" class="col-sm-6 col-md-4 col-lg-3"></product-card>
        </b-row>
        </div>
  </div>
         
</template>

<script>
    import ProductCard from '../components/ProductCard.vue';
    import axios from 'axios';
    export default {
        name: 'home',
        components :{
        productCard : ProductCard,
        },
         data () {
          return {
            musiques : []
          }
          
        },
        methods :{
            getLivres : function(){
                var self = this;
                axios({
                    method: 'get',
                    url: '/get/products/musiques',
                }).then(function (response) {
                self.musiques = response.data;
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

