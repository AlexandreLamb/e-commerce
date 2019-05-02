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
        <b-row>
            <product-card @cliked="toggleVisibility" v-for="product in products" :key="product.id" :product="product" class="col-sm-6 col-md-4 col-lg-3"></product-card>
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
              product: {},
            products : [],
            onLoad : true,
            searchName: "",
            showCollapse : false,

          }
          
        },
        methods :{
            getImg(product){
        
      },
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
            },
            toggleVisibility(value){
                console.log(value);
                this.product = value;
                this.showCollapse = true;
                window.scrollTo({ top: 500, behavior: 'smooth' })                 
            }
        },
        created: function(){
            this.getProducts()
        }
    }
</script>