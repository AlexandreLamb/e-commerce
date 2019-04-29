<template>
  <div>
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
          type="email"
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
        <b-form-group id="input-group-4" label="Photo :" label-for="input-4">
            <b-form-file
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
  </div>
</template>

<script>
    import axios from 'axios'
  export default {
      props: {
          user :{
              type : Object,
              default: null,
          }
      },
    data() {
      return {
        options: [
          { value: null, text: 'Choisissez une categorie ' },
          { value: 'a', text: 'Sport et loisir' },
          { value: 'b', text: 'Musiques' },
          { value: 'c', text: 'Vetements' },
          { value: 'd', text: 'Livres'}
        ],
        form: {
          price: '',
          descritption: '',
          name: '',
          file: null,
          categorie :null,
        },
      }
    },
    methods: {

      onSubmit(evt) {
        evt.preventDefault()
        var self = this;
        if(self.user != null){
       axios({
        method: 'post',
        url: '/add/product',
        data: {
         price: self.form.price,
          descritption: self.form.description,
          name: self.form.name,
          file: sefl.form.file,
          categorie : self.form.categorie,
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