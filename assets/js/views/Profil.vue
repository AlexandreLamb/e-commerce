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
      pattern="[0]{1}[1-9]{1}[0-9]{8}"
      title="0XXXXXXXXX"
      required
    ></b-input>
    <b-button v-on:click="update()" variant="primary">Save</b-button>
  </b-form>
  </b-collapse>
</div>

 <hr class="my-4">
    <p>Adresse de livraison<b-button class="ml-5" size="sm" v-on:click="toggleAdresse = !toggleAdresse" v-b-toggle.collapse-2 variant="primary">Modifier votre adresse de livraison</b-button>
    </p>
    <h1 v-show="toggleAdresse">
    {{user.adresse}}, {{user.ville}}, {{user.codePostale}}, {{user.pays}}
    </h1>
    <div>
  <b-collapse id="collapse-2" class="mt-2">
    <b-form inline>
    <label class="sr-only" for="inline-form-input-name">Adresse de livraison</label>
    <b-input
      id="inline-form-input-adresse"
      class="mb-2 mr-sm-2 mb-sm-0"
      placeholder="Entrer votre adresse"
      v-model="user.adresse"
    ></b-input>
    <b-input
      id="inline-form-input-ville"
      class="mb-2 mr-sm-2 mb-sm-0"
      placeholder="Entrer votre ville"
      v-model="user.ville"
    ></b-input>
    <b-input
      id="inline-form-input-codePostale"
      class="mb-2 mr-sm-2 mb-sm-0"
      placeholder="Entrer votre code postale"
      v-model="user.codePostale"
      pattern="[0-9]{5}"
      title="XXXXX"
      type="text"
    ></b-input>
    <b-form-select
          id="input-3"
          v-model="user.pays"
          :options="pays"
          required
        ></b-form-select>
    <b-button v-on:click="update()" variant="primary">Save</b-button>
  </b-form>
  </b-collapse>
</div>

  <hr class="my-4">
    <p>Date de naissance
    </p>
    <h1>
     {{user.date_naissance}}
    </h1>


 <hr class="my-4">
    <p>Mot de passe<b-button class="ml-5" size="sm" v-on:click="toggleMdp = !toggleMdp" v-b-toggle.collapse-3 variant="primary">Modifier votre mot de passe</b-button>
    </p>
    <div>
  <b-collapse id="collapse-3" class="mt-2">
    <b-form inline>
    <label class="sr-only" for="inline-form-input-name">Mot de passe</label>
    <b-input
      id="inline-form-input-name"
      class="mb-2 mr-sm-2 mb-sm-0"
      placeholder="Entrer votre nouveau mot de passe"
      v-model="user.password"
    ></b-input>
    <b-input
      id="inline-form-input-name"
      class="mb-2 mr-sm-2 mb-sm-0"
      placeholder="Entrez à nouveau votre mot de passe"
      v-model="user.pain_password"
    ></b-input>
    <b-button v-on:click="update()" variant="primary">Save</b-button>
  </b-form>
  </b-collapse>
</div>
  
  </b-jumbotron>

  <b-jumbotron>
    <template slot="header">Ma carte bancaire</template>
    <template slot="lead">
      Voici l'espace concernant votre carte bancaire. 
      <b-button class="ml-5" size="sm" v-on:click="toggleCarte = !toggleCarte" v-b-toggle.collapse-4 variant="primary">Modifier mes informations bancaires</b-button>
    </template>
    <div>
  <b-collapse id="collapse-4" class="mt-2">
    <b-form inline>
    <label class="sr-only" for="inline-form-input-name"></label>
     
     <b-input-group           
       prepend="Type de Carte Bancaire">
        <b-form-select
          id="inline-form-input-name"
          v-model="user.type"
          :options="type"
          required
        ></b-form-select>
  </b-input-group>

    <b-input
      id="inline-form-input-name"
      class="mb-1 mr-sm-1 mb-sm-0"
      placeholder="Numéro de carte bancaire"
      v-model="user.numero"
      pattern="[0-9]{16}"
      title="XXXXXXXXXXXXXXXX"
      type="text"
      required
    ></b-input>
    
    <b-input
      id="inline-form-input-name"
      class="mb-2 mr-sm-2 mb-sm-0"
      placeholder="Date de validité"
      v-model="user.dateValidite"
      pattern="[0-1]{1}[0-2]/[1-2]{1}[0-9]{1}"
      title="XX/XX"
      type="text"
      required
    ></b-input>
        <b-input
      id="inline-form-input-name"
      class="mb-2 mr-sm-2 mb-sm-0"
      type="text"
      placeholder="Cryptogramme"
      v-model="user.crypto"
      pattern="[0-9]{3}"
      title="XXX"
      required
    ></b-input>
    <b-button v-on:click="update()" variant="primary">Save</b-button>
  </b-form>
  </b-collapse>
</div>

    <hr class="my-4">
    <div class="card bg-dark text-white">
  <img class="card-img" src="../../pics/cartebleu2.jpg" alt="Card image">
  <div class="card-img-overlay">
    <h1 class="card-text-3"> Mr {{user.userlastname}}  {{user.username}} </h1>
    <h1 class="card-text-4"> {{user.type}}</h1>
    <h2 class="card-text-1">{{user.numero.substring(0,4)}} &nbsp; &nbsp; &nbsp; &nbsp; {{user.numero.substring(4,8)}} &nbsp; &nbsp; &nbsp; &nbsp;{{user.numero.substring(8,12)}} &nbsp; &nbsp; &nbsp; &nbsp; {{user.numero.substring(12,16)}} </h2>
        <h2 class="card-text-2"> {{user.dateValidite}}</h2>
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
            pays: ['France Metropole', 'France Dom Tom', 'Belgique', 'Suisse'],
            type : ['MasterCard','Visa'],
              user : isNullOrUndefined(localStorage.user) ? null : JSON.parse(localStorage.user),
              togglePhone : true,
              toggleAdresse : true,
              toggleCarte : true,
              
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
          pain_password: self.user.pain_password,
          date_naissance : self.user.date_naissance,
          ville: self.user.ville,
          adresse: self.user.adresse,
          crypto: self.user.crypto,
          dateValidite : self.user.dateValidite,
          type : self.user.type,
          numero :self.user.numero,
          codePostale :self.user.codePostale,
          pays : self.user.pays,
        }
          }).then(function (response) {
           localStorage.user = JSON.stringify(response.data); 
              window.scrollTo({top : 0 , behavior: 'smooth'})
              self.togglePhone = true;
              self.toggleAdresse = true;
              self.toggleCarte = true;
          })
          .catch(function (error) {
          console.log(error);
        })
          }
        },
    
    }
</script>

<style>
  .card-text-1 {
    margin-left: 10%;
    margin-top: 16%;
    font-size: 3rem;
    color: black;
  }

  .card-text-2 {
    margin-left: 70%;
    font-size: 2rem;
  }

  .card-text-4{
    margin-top: 20%;
    margin-left: 30%;
    font-size: 3rem;
  }

  .card-text-3 {
    margin-left: 11%;
    font-size: 2rem;
    color: black;
    margin-top: 9%;
  }
</style>