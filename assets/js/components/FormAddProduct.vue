<template>
  <div>
    <b-alert
      :show="dismissCountDown"
      dismissible
      name = "oui"
      variant="warning"
      @dismissed="dismissCountDown=0"
      @dismiss-count-down="countDownChanged"
    >
      Nouveau produit ajouté, vous allez être redirigé à la page d'acceuil dans {{ dismissCountDown }} secondes
    </b-alert>
    <div class="text-center" v-show="!onLoad">
  <b-spinner label="Spinning"></b-spinner>
  <b-spinner type="grow" label="Spinning"></b-spinner>
  <b-spinner variant="primary" label="Spinning"></b-spinner>
  <b-spinner variant="primary" type="grow" label="Spinning"></b-spinner>
  <b-spinner variant="success" label="Spinning"></b-spinner>
  <b-spinner variant="success" type="grow" label="Spinning"></b-spinner>
</div>
      <b-container v-show="onLoad">
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
        id="input-group-2"
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
        <b-form-group id="input-group-4" label="Photo :" label-for="input-41" >
            <b-form-file
            @change="onFileChange1"
        id="input-41"
      v-model="form.file1"
      :state="Boolean(form.file1)"
      placeholder="Choisissez une photo"
      drop-placeholder="Drop file here..."
        ></b-form-file>
    <b-form-file
            @change="onFileChange2"
        id="input-42"
      v-model="form.file2"
      :state="Boolean(form.file2)"
      placeholder="Choisissez une photo"
      drop-placeholder="Drop file here..."
        ></b-form-file>
    <b-form-file
            @change="onFileChange3"
        id="input-43"
      v-model="form.file3"
      :state="Boolean(form.file3)"
      placeholder="Choisissez une photo"
      drop-placeholder="Drop file here..."
        ></b-form-file>
    <div class="mt-3">Selected file : {{ form.file1 ? form.file1.name : '' }} , {{ form.file2 ? form.file2.name : '' }} , {{ form.file3 ? form.file3.name : '' }}</div>
      </b-form-group>
      <b-form-group id="input-group-5" label="Categorie :" label-for="input-5">
            <b-form-select v-model="form.categorie" :options="options"></b-form-select>
      </b-form-group>
      <b-form-group id="input-group-6" label="Quantite :" label-for="input-6">
            <b-form-input
          id="input-6"
          v-model="form.quantite"
          type="number"
          required
        ></b-form-input>
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
          onLoad : true,
          imgSrc:"",
        options: [
          { value: null, text: 'Choisissez une categorie ' },
          { value: 'SportEtLoisirs', text: 'Sport et loisirs' },
          { value: 'Musiques', text: 'Musiques' },
          { value: 'Vetements', text: 'Vetements' },
          { value: 'Livres', text: 'Livres'}
        ],
        form: {
          price: '',
          description: '',
          name: '',
          file1:null,
          file2:null,
          file3:null,
          categorie :null,
          img1 : '',
          img2 : '',
          img3 : '',
          quantite : 0,
        },
         user : isNullOrUndefined(localStorage.user) ? null : JSON.parse(localStorage.user),
         dismissSecs: 5,
        dismissCountDown: 0
      }
    },
    methods: {
         onFileChange1(e) {
           var self = this;
      var file = e.target.files[0];
      var reader = new FileReader();
      reader.readAsDataURL(file);
   reader.onload = function () {
               self.form.img1 =  reader.result;

      };
      this.imgSrc = URL.createObjectURL(file);
        },
        onFileChange2(e) {
           var self = this;
      var file = e.target.files[0];
      var reader = new FileReader();
      reader.readAsDataURL(file);
   reader.onload = function () {
               self.form.img2 =  reader.result;

      };
      this.imgSrc = URL.createObjectURL(file);
        },
        onFileChange3(e) {
           var self = this;
      var file = e.target.files[0];
      var reader = new FileReader();
      reader.readAsDataURL(file);
   reader.onload = function () {
               self.form.img3 =  reader.result;

      };
      this.imgSrc = URL.createObjectURL(file);
        },

      onSubmit(evt) {
        evt.preventDefault()
        var self = this;
        if(self.user != null){
          this.onLoad = ! this.onLoad;
       axios({
        method: 'post',
        url: '/add/product',
        data: {
         price: self.form.price,
          description: self.form.description,
          name: self.form.name,
          categorie : self.form.categorie,
          userId : self.user.id,
          img1 : self.form.img1,
          img2 : self.form.img2,
          img3 : self.form.img3,
          quantite : self.form.quantite
        }
          }).then(function (response) {
            self.showAlert();
            self.$router.push('/home');

          })
          .catch(function (error) {
          console.log(error);
        })
        }
      },
      countDownChanged(dismissCountDown) {
        this.dismissCountDown = dismissCountDown
      },
      showAlert() {
        this.dismissCountDown = this.dismissSecs
      },
       dataURItoBlob(dataURI, callback) {
    // convert base64 to raw binary data held in a string
    // doesn't handle URLEncoded DataURIs - see SO answer #6850276 for code that does this
    var byteString = atob(dataURI.split(',')[1]);

    // separate out the mime component
    var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0]

    // write the bytes of the string to an ArrayBuffer
    var ab = new ArrayBuffer(byteString.length);
    var ia = new Uint8Array(ab);
    for (var i = 0; i < byteString.length; i++) {
        ia[i] = byteString.charCodeAt(i);
    }

    // write the ArrayBuffer to a blob, and you're done
    var bb = new Blob([ab]);
    return bb;
}
      
    },
    computed : {
      
    
    }
    }
  
</script>
