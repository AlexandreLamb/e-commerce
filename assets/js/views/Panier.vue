<template>
    <div>
        <br>
        <h1 v-if="totalPanier == 0" align="center">Votre panier est vide, achetez vite !</h1>
        <h1 v-else align="center"> Total de payer : {{totalPanier}} €</h1>
        <div class="text-center" v-show="onLoad"> 
            <b-spinner label="Spinning"></b-spinner>
            <b-spinner type="grow" label="Spinning"></b-spinner>
            <b-spinner variant="primary" label="Spinning"></b-spinner>
            <b-spinner variant="primary" type="grow" label="Spinning"></b-spinner>
            <b-spinner variant="success" label="Spinning"></b-spinner>
            <b-spinner variant="success" type="grow" label="Spinning"></b-spinner>
        </div>
        <div class="container pt-3">
             
        <b-row>
            <product-card-panier @cliked="deleteProduct" v-for="product in user.panier" :key="product.id" :product="product" class="col-sm-6 col-md-4 col-lg-3"></product-card-panier>
        </b-row>
        </div>
    </div>
</template>

<script>
      import { isNullOrUndefined } from 'util';
      import ProductCardPanier from '../components/ProductCardPanier.vue';
      import axios from 'axios';
  export default {
      components :{
        ProductCardPanier : ProductCardPanier,
        },
    
    data() {
      return {
         user : isNullOrUndefined(localStorage.user) ? null : JSON.parse(localStorage.user),
         totalPanier : 0,
         onLoad :true,
      }
    },
    methods: {
      getPannier(){
        var self = this;
        self.onLoad=true;
         self.user = isNullOrUndefined(localStorage.user) ? null : JSON.parse(localStorage.user)
        axios({
        method: 'get',
        url: '/get/panier/user/'+self.user.id,
        
          }).then(function (response) {
            console.log(response.data);
            self.user.panier = response.data
            self.totalPanier = self.countPrice(self.user.panier);
            self.onLoad=false;

          })
          .catch(function (error) {
          console.log(error);
        })
      },
      countPrice(panier){
        var total = 0;
        panier.forEach(element => {
          total += element.price;
        });
        return total;
      },
      deleteProduct(product){
        var self = this;
        self.onLoad=true;
        axios({
        method: 'post',
        url: '/delete/product/panier',
        data: {
          userId: self.user.id,
          productId: product.id,
        }
          }).then(function (response) {
            console.log(response.data)
            self.user.panier = response.data;
            self.totalPanier = self.countPrice(self.user.panier); 
            self.onLoad=false;

          })
          .catch(function (error) {
          console.log(error);
        })
    },
    },
    created : function(){
      this.getPannier();
    }
  }
</script>
