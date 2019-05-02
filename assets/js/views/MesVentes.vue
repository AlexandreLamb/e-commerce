<template>
    <div>   
        <h1> Mes ventes actuelles </h1>
        <div class="text-center" v-show="onLoad"> 
            <b-spinner label="Spinning"></b-spinner>
            <b-spinner type="grow" label="Spinning"></b-spinner>
            <b-spinner variant="primary" label="Spinning"></b-spinner>
            <b-spinner variant="primary" type="grow" label="Spinning"></b-spinner>
            <b-spinner variant="success" label="Spinning"></b-spinner>
            <b-spinner variant="success" type="grow" label="Spinning"></b-spinner>
        </div>
        <b-row>
            <product-cardV @cliked="deleteProduct" v-for="product in products" :key="product.id" :product="product" class="col-sm-6 col-md-4 "></product-cardV>
        </b-row>
    </div>
    
</template>

<script>
    import Carousel from '../components/Carousel.vue';
    import ProductCardV from '../components/ProductCardV.vue';
    import axios from 'axios';
    import { isNullOrUndefined } from 'util';


    export default {
        components :{
        productCardV : ProductCardV,
        },
         data () {
          return {
            products : [],
            user : isNullOrUndefined(localStorage.user) ? null : JSON.parse(localStorage.user),
            onLoad : false,
          }
          
        },
        methods :{
            getVentes(){
                self = this;
                self.onLoad = true;
                axios({
            method: 'get',
            url: '/get/vente/user/'+self.user.id,
          }).then(function (response) {
            self.products = response.data; 
            self.onLoad = false;
          })
          .catch(function (error) {
          console.log(error);
        })
            },
        deleteProduct(product){
        var self = this;
        self.onLoad=true;
        axios({
        method: 'post',
        url: '/delete/product/ventes',
        data: {
          userId: self.user.id,
          productId: product.id,
        }
          }).then(function (response) {
            console.log(response.data)
            self.products = response.data; 
            self.onLoad=false;

          })
          .catch(function (error) {
          console.log(error);
        })
    },
        },
        created: function(){
            self.onLoad = true;
            this.getVentes()
        },
    }
</script>