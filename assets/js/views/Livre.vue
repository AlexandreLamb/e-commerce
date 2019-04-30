<template>
    <div> 
        <h1 align="center">Nos livres</h1>
        <div>
            <b-collapse id="collapse-1" v-model="showCollapse" class="mt-2">
            <b-card>
                <button type="button" v-on:click="showCollapse= !showCollapse" class="close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </button>
                <p class="card-text">{{product.name}}</p>
                 <b-card>{{product.description}}</b-card>
            </b-card>
            </b-collapse>
        </div>
         <div class="container pt-3">
        <b-row>
            <product-card v-for="livre in livres" :key="livre.id" :product="livre" class="col-sm-6 col-md-4 col-lg-3" @cliked="toggleVisibility"></product-card>
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
            livres : [],
            product :{},
            showCollapse : false,

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
            },
             toggleVisibility(value){
                console.log(value);
                this.product = value;
                this.showCollapse = true;
                window.scrollTo({ top: 0, behavior: 'smooth' })                 
            }
        },
        mounted : function(){
            this.getLivres();
        }
    }
</script>

