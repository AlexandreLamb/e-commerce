<template>
<div>
  <b-jumbotron>
    <template slot="header">Espace Client</template>

    <template slot="lead">
      This is a simple hero unit, a simple jumbotron-style component for calling extra attention to
      featured content or information.
    </template>

    <hr class="my-4">

    <p>
      It uses utility classes for typography and spacing to space content out within the larger
      container.
    </p>

    <b-button variant="primary" to="/panier">Mon panier</b-button>
    <b-button variant="success" href="#">Historique de commande</b-button>
  </b-jumbotron>
  

  <b-jumbotron>
    <template slot="header">Mes informations</template>

    <template slot="lead">
      Vos informations sont tenus confidentiels par Boomerang Corporation. Boomerang Corporation
      s'engage à ne pas les diffuser sans votre consentement (clin d'oeil) </br>
    </template>

    <hr class="my-4">
    <p>Nom
    </p>
    <h1>
      {{user.userlastname}}
    </h1>

  <hr class="my-4">
    <p>Prénom
    </p>
    <h1>
      {{user.username}}
    </h1>
  
  <hr class="my-4"> 
    <p>Email
    </p>
    <h1>
    {{user.email}}
    </h1>
  
  <hr class="my-4">
    <p>Numéro de téléphone   <b-button class="ml-5" size="sm" v-on:click="togglePhone = !togglePhone" v-b-toggle.collapse-1 variant="primary">Modifier Numero de telephone</b-button>

    </p>
    <h1 v-show="togglePhone">
     {{user.telephone}}
    </h1>
    <div>
  <b-collapse id="collapse-1" class="mt-2">
    <b-form inline>
    <label class="sr-only" for="inline-form-input-name">Telephone</label>
    <b-input
      id="inline-form-input-name"
      class="mb-2 mr-sm-2 mb-sm-0"
      placeholder="entrez votre numero de telephone"
      v-model="user.telephone"
    ></b-input>
    <b-button v-on:click="update()" variant="primary">Save</b-button>
  </b-form>
  </b-collapse>
</div>

<hr class="my-4">
    <p>Addresse de livraison <b-button variant="primary" href="#">Modifier son adresse de livraison</b-button>
    </p>
    <h1>
     {{user.adresse}}, {{user.ville}}
    </h1>
     
  <hr class="my-4">
    <p>Date de naissance
    </p>
    <h1>
     {{user.date_naissance}}
    </h1>

     <hr class="my-4">
    <p>Mot de passe <b-button variant="primary" href="#">Modifier son mot de passe</b-button>
    </p>
    <h1> *************</h1>
  </b-jumbotron>

  <b-jumbotron>
    <template slot="header">Ma carte bancaire</template>

    <template slot="lead">
     Voici l'espace concernant votre carte bancaire. <b-button variant="primary" href="#">Modifier mes informations bancaires</b-button>
    </template>

    <hr class="my-4">
    <div class="card bg-dark text-white"
    >
  <img class="card-img" src="../../pics/cartebleu2.png" alt="Card image">
  <div class="card-img-overlay">
    <h2 class="card-text-1">1234 1234 1234 1234 </h2>
        <h2 class="card-text-2">  12/34</h2>
    <h1 class="card-text-3"> Mr {{user.userlastname}}  {{user.username}} </h1>
  </div>
</div>
  </b-jumbotron>
  
</div>
</template>

<script>
    import { isNullOrUndefined } from 'util';
    import axios from 'axios'; 
    export default {
        name: 'profil',
        components :{
        },
         data () {
          return {
              user : isNullOrUndefined(localStorage.user) ? null : JSON.parse(localStorage.user),
              togglePhone : true,
          }
        },
        methods: {
          update(){
            var self =this;
axios({
        method: 'post',
        url: '/update/user',
        data: {
          userId : self.user.id,
          userlastname: self.user.userlastname,
          username: self.user.username,
          email: self.user.email,
          telephone: self.user.telephone,
          password: self.user.password,
          date_naissance : self.user.date_naissance,
          ville: self.user.ville,
          adresse: self.user.adresse,
        }
          }).then(function (response) {
           localStorage.user = JSON.stringify(response.data); 
              window.scrollTo({top : 0 , behavior: 'smooth'})
              self.togglePhone = true;
          })
          .catch(function (error) {
          console.log(error);
        })
          }
        }
    }
</script>

<style>
  .card-text-1 {
    margin-left: 7%;
    margin-top: 41%;
    font-size: 3rem;
  }

  .card-text-2 {
    margin-left: 50%;
    font-size: 2rem;
  }

  .card-text-3 {
    margin-left: 11%;
    font-size: 2rem;
  }
</style>


