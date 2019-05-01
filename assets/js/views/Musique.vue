<template>
    <div> 
        <h1 align="center">Nos Musiques</h1>
        <div class="text-center" v-show="onLoad">
            <b-spinner label="Spinning"></b-spinner>
            <b-spinner type="grow" label="Spinning"></b-spinner>
            <b-spinner variant="primary" label="Spinning"></b-spinner>
            <b-spinner variant="primary" type="grow" label="Spinning"></b-spinner>
            <b-spinner variant="success" label="Spinning"></b-spinner>
            <b-spinner variant="success" type="grow" label="Spinning"></b-spinner>
        </div>
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
            <product-card v-for="musique in musiques" :key="musique.id" :product="musique" class="col-sm-6 col-md-4 col-lg-3" @cliked="toggleVisibility"></product-card>
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
            musiques : [],
            product : {},
            showCollapse : false,
            onLoad :true,
          }
          
        },
        methods :{
            getLivres : function(){
                var self = this;
                self.onLoad=true;
                axios({
                    method: 'get',
                    url: '/get/products/musiques',
                }).then(function (response) {
                self.musiques = response.data;
                self.onLoad=false;
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

