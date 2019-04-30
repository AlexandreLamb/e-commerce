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
      This is a simple hero unit, a simple jumbotron-style component for calling extra attention to
      featured content or information.
      <b-button variant="primary" href="#">Modifier mes informations</b-button>
    </template>

    <hr class="my-4">
    <h1>
      Nom
    </h1>
    <p>
      It uses utility classes for typography and spacing to space content out within the larger
      container.
    </p>
  

  <hr class="my-4">
    <h1>
      Prénom
    </h1>
    <p>
      It uses utility classes for typography and spacing to space content out within the larger
      container.
    </p>
  
  <hr class="my-4">
    <h1>
      Adresse mail
    </h1>
    <p>
      It uses utility classes for typography and spacing to space content out within the larger
      container.
    </p>

  <hr class="my-4">
    <h1>
      Numéro de téléphone
    </h1>
    <p>
      It uses utility classes for typography and spacing to space content out within the larger
      container.
    </p>
  </b-jumbotron>

</div>

</template>