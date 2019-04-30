<template>
    <div>
        <br>
        <h1 align="center">Votre panier est vide, achetez vite ! {{totalPanier}}</h1>
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
         totalPanier : 0
      }
    },
    methods: {
      getPannier(){
        var self = this;
        axios({
        method: 'get',
        url: '/get/panier/user/'+self.user.id,
        
          }).then(function (response) {
            console.log(response.data);
            self.user.panier = response.data
            self.totalPanier = self.countPrice(self.user.panier);

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
        axios({
        method: 'post',
        url: '/delete/product/panier',
        data: {
          userId: self.user.id,
          productId: product.id,
        }
          }).then(function (response) {
            console.log(response.data)
            localStorage.user = JSON.stringify(response.data); 

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
