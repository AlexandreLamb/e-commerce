<template>
    <div>
  <b-card
    :title="vendeur.name"
    img-src=""
    img-alt="No Image"
    img-top
    tag="article"
    style="max-width: 20rem;"
    class="mb-2"
    img-height="100px"
    img-width="300px"
  >
    <b-card-text>
      {{vendeur.userlastname}}
    </b-card-text>
    <b-card-text> {{vendeur.username}}</b-card-text>
    <b-button-group>
      <b-button v-on:click="deleteVendeur" variant="success">Supprimer le vendeur</b-button>
    </b-button-group>
  </b-card>
</div>
</template>
<script>
    import { isNullOrUndefined } from 'util';
    import axios from 'axios'; 
    export default {
        components :{
        },
        props : {
          vendeur : {
            type : Object,
            default () {
                return { }
            }
          }
        },
         data () {
          return {
              user : isNullOrUndefined(localStorage.user) ? null : JSON.parse(localStorage.user),
              
          }
        },
        methods: {
         deleteVendeur (){
           var self = this;
                self.onLoad = true;
                axios({
                    method: 'get',
                    url: '/delete/vendeurs/'+self.vendeur.id,
                }).then(function (response) {
                self.vendeur = response.data;
                 self.onLoad = false;
                })
                .catch(function (error) {
                    console.log(error);
                })
         }
          
        }
    }
</script>