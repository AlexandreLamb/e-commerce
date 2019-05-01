<template>
    <div>   
        <carousel></carousel>
                <b-form-input type="text" v-model="searchName" placeholder="Search" @keyup.enter="search()" ></b-form-input>

        <h1> Nos meilleures ventes </h1>
        <div class="text-center" v-show="onLoad">
            <b-spinner label="Spinning"></b-spinner>
            <b-spinner type="grow" label="Spinning"></b-spinner>
            <b-spinner variant="primary" label="Spinning"></b-spinner>
            <b-spinner variant="primary" type="grow" label="Spinning"></b-spinner>
            <b-spinner variant="success" label="Spinning"></b-spinner>
            <b-spinner variant="success" type="grow" label="Spinning"></b-spinner>
        </div>
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
            products : [],
            onLoad : true,
            searchName: "",
          }
          
        },
        methods :{
            getProducts(){
                self = this;
                self.onLoad = true;
                axios({
            method: 'get',
            url: '/get/products',
          }).then(function (response) {
            console.log(response.data);
            self.products = response.data; 
            self.onLoad = false;

          })
          .catch(function (error) {
          console.log(error);
        })
            },
            search(){
                self = this;
                self.onLoad = true;
                if(self.searchName != ''){
                axios({
            method: 'get',
            url: '/search/products/'+self.searchName,
          }).then(function (response) {
            self.products = response.data; 
            self.onLoad = false;

          })
          .catch(function (error) {
          console.log(error);
        })
            } else{
                self.getProducts();
            }
            }
        },
        created: function(){
            this.getProducts()
        }
    }
</script>