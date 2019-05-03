<template>
    <div> 
        <h1 align="center">Espace administrateur</h1> 
        <br>
        <h1>Mes vendeurs   <b-button variant="success">Ajouter un vendeur</b-button></h1>
         <div class="text-center" v-show="onLoad">
            <b-spinner label="Spinning"></b-spinner>
            <b-spinner type="grow" label="Spinning"></b-spinner>
            <b-spinner variant="primary" label="Spinning"></b-spinner>
            <b-spinner variant="primary" type="grow" label="Spinning"></b-spinner>
            <b-spinner variant="success" label="Spinning"></b-spinner>
            <b-spinner variant="success" type="grow" label="Spinning"></b-spinner>
        </div>
        <b-row>
            <product-card-vendeur v-for="user in user" :key="user.id" :product="livre" class="col-sm-6 col-md-4 col-lg-3" @cliked="toggleVisibility"></product-card-vendeur>
        </b-row>
        <br>
        <h1>Mes produits</h1><br>
        <h2>Les livres</h2>
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
            <product-card v-for="livre in livres" :key="livre.id" :product="livre" class="col-sm-6 col-md-4 col-lg-3" @cliked="toggleVisibility"></product-card>
        </b-row>
        </div>


       <div> 
        <h2>Nos vêtements</h2>
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
            <product-card v-for="vetement in vetements" :key="vetement.id" :product="vetement" class="col-sm-6 col-md-4 col-lg-3" @cliked="toggleVisibility"></product-card>
        </b-row>
        </div>

         <div> 
        <h2>Sport et Loisirs</h2>
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
            <product-card v-for="sportEtLoisir in sportEtLoisirs" :key="sportEtLoisir.id" :product="sportEtLoisir" class="col-sm-6 col-md-4 col-lg-3" @cliked="toggleVisibility"></product-card>
        </b-row>
        </div>
  </div>
   <div> 
        <h2>Nos Musiques</h2>
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
  </div>
    </div>
         
</template>

<script>
    import ProductCard from '../components/ProductCard.vue';
    import ProductCardVendeur from '../components/ProductCardVendeur.vue';
    import axios from 'axios';
    export default {
        components :{
        productCard : ProductCard,
        productCardVendeur : ProductCardVendeur,
        },
         data () {
          return {
            user : [],
            livres : [],
            vetements : [],
            musiques : [],
            sportEtLoisirs : [],
            product :{},
            showCollapse : false,
            onLoad : true,

          }
          
        },
        methods :{
            getLivres : function(){
                var self = this;
                self.onLoad = true;
                axios({
                    method: 'get',
                    url: '/get/products/livres',
                }).then(function (response) {
                self.livres = response.data;
                 self.onLoad = false;
                })
                .catch(function (error) {
                    console.log(error);
                })
            },
            getVetements : function(){
                var self = this;
                self.onLoad=true
                axios({
                    method: 'get',
                    url: '/get/products/vetements',
                }).then(function (response) {
                self.vetements = response.data;
                self.onLoad=false;
                })
                .catch(function (error) {
                    console.log(error);
                })
            },
             getSportEtLoisirs : function(){
                var self = this;
                self.onLoad=true;
                axios({
                    method: 'get',
                    url: '/get/products/sportetloisirs',
                }).then(function (response) {
                self.sportEtLoisirs = response.data;
                self.onLoad=false;
                })
                .catch(function (error) {
                    console.log(error);
                })
            },
              getMusiques : function(){
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
            },
        },
        mounted : function(){
            this.getLivres();
            this.getVetements();
            this.getSportEtLoisirs();
            this.getMusiques();
        },
    }
</script>

