<template>
  <div>
      <b-container>
            <b-row>
            <b-col>
    <b-form @submit="onSubmit">
      <b-form-group
        id="input-group-1"
        label="Product name:"
        label-for="input-1"
        description=""
      >
        <b-form-input
          id="input-1"
          v-model="form.name"
          type="text"
          required
          placeholder="Entrer un nom de produit"
        ></b-form-input>
      </b-form-group>

      <b-form-group
        id="input-group-1"
        label="Description:"
        label-for="input-2"
        description=""
      >
        <b-form-input
          id="input-2"
          v-model="form.description"
          type="text"
          required
          placeholder="Entrez une description"
        ></b-form-input>
      </b-form-group>


      <b-form-group id="input-group-3" label="Prix :" label-for="input-3">
        <b-form-input
          id="input-3"
          v-model="form.price"
          type="number"
          required
        ></b-form-input>
      </b-form-group>
        <b-form-group id="input-group-4" label="Photo :" label-for="input-4" >
            <b-form-file
            @change="onFileChange"
        id="input-4"
      v-model="form.file"
      :state="Boolean(form.file)"
      placeholder="Choisissez une photo"
      drop-placeholder="Drop file here..."
        ></b-form-file>
    <div class="mt-3">Selected file: {{ form.file ? form.file.name : '' }}</div>
      </b-form-group>
      <b-form-group id="input-group-5" label="Categorie :" label-for="input-5">
            <b-form-select v-model="form.categorie" :options="options"></b-form-select>
      </b-form-group>
      <b-button type="submit" variant="primary">Submit</b-button>
    </b-form>
    </b-col>
            <b-col>
                    <b-card
    :title="form.name"
    :img-src="imgSrc"
    img-alt="No Image"
    img-top
    tag="article"
    style="max-width: 20rem;"
    img-width ="20rem"
    img-height="300"
    class="mb-2"
  >
    <b-card-text>
      {{form.description}}
    </b-card-text>
    <b-card-text> {{form.price}} Euros</b-card-text>
    <b-card-footer>Categorie : {{form.categorie}}</b-card-footer>
  </b-card>
            </b-col>
     </b-row>
        </b-container>
  </div>
</template>

<script>
    import axios from 'axios'
    import ProductCard from '../components/ProductCard.vue';
    import { isNullOrUndefined } from 'util';

  export default {
      components :{
        productCard : ProductCard
        },
      props: {
          
      },
    data() {
      return {
          imgSrc:"",
        options: [
          { value: null, text: 'Choisissez une categorie ' },
          { value: 'Sport et loisir', text: 'Sport et loisir' },
          { value: 'Musiques', text: 'Musiques' },
          { value: 'Vetements', text: 'Vetements' },
          { value: 'Livres', text: 'Livres'}
        ],
        form: {
          price: '',
          description: '',
          name: '',
          file:null,
          categorie :null,
        },
         user : isNullOrUndefined(localStorage.user) ? null : JSON.parse(localStorage.user)
      }
    },
    methods: {
         onFileChange(e) {
             console.log('test');
      const file = e.target.files[0];
      this.imgSrc = URL.createObjectURL(file);
    
        },

      onSubmit(evt) {
        evt.preventDefault()
        var self = this;
        if(self.user != null){
       axios({
        method: 'post',
        url: '/add/product',
        data: {
         price: self.form.price,
          description: self.form.description,
          name: self.form.name,
          file: self.form.file.name,
          categorie : self.form.categorie,
          userId : self.user.id,
        }
          }).then(function (response) {
          
          })
          .catch(function (error) {
          console.log(error);
        })
        }
      },
      
    },
    computed : {
      
    
    }
    }
  
</script>
