<template>
    <div>
      <b-card>
  <carousel :tabImg="[product.img,product.img]"></carousel>

  <div class="text-center" v-show="onLoad" >
            <b-spinner label="Spinning"></b-spinner>
            <b-spinner variant="primary" label="Spinning"></b-spinner>
        </div>
    <b-card-text>
      {{product.description}}
    </b-card-text>
    <b-card-text> {{product.price}} Euros</b-card-text>
    <b-button-group>
      <b-button v-on:click="toggleVisibility()" variant="warning">Voir le produit</b-button>
      <b-button v-on:click="addPannier()" variant="success">Ajouter au Panier</b-button>
    </b-button-group>
    
  </b-card>
</div>
</template>
<script>
      import { isNullOrUndefined } from 'util';
      import axios from 'axios';
       import Carousel from '../components/CarouselProduit.vue';
  export default {
    components : {
    carousel : Carousel,

    },
    props: {
      product : {
        type : Object,
        default() { 
          return{   name : "Pas de nom de produit",
                    description : "Pas de description",
                    price : 0,
                    categorie : "none"
          }
        }
          }
      }

    ,
    data() {
      return {
         user : isNullOrUndefined(localStorage.user) ? null : JSON.parse(localStorage.user),
         visibility : false,
         onLoad: null ,
      }
    },
    methods: {
      addPannier(){
        var self = this;
        self.user = isNullOrUndefined(localStorage.user) ? null : JSON.parse(localStorage.user);
        axios({
        method: 'post',
        url: '/add/product/panier',
        data: {
          userId: self.user.id,
          productId: self.product.id,
        }
          }).then(function (response) {
            console.log(response.data);
          })
          .catch(function (error) {
          console.log(error);
        })
      },
      toggleVisibility(){
        var self = this;
        self.$emit('cliked' , self.product);
                self.visibility = !self.visibility
      },
      getImg(){
        var self = this;
        self.onLoad = true;
        axios({
        method: 'get',
        url: '/get/img/'+self.product.id,
          }).then(function (response) {
            self.product.img =  response.data.img;
            self.onLoad = false;
          })
          .catch(function (error) {
          console.log(error);
        })
      },
    },
    created : function() {
      this.getImg();
    }
  }
</script>