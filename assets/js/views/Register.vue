<template>
  <div>
 
      <b-form-group
        id="input-group-1"
        label="Nom :"
        label-for="input-1"
        description=""
      >
        <b-form-input
          id="input-1"
          v-model="form.userlastname"
          type="text"
          required
          placeholder="Entrez votre nom de famille"
        ></b-form-input>
      </b-form-group>

      <b-form-group
        id="input-group-2"
        label="Prénom:"
        label-for="input-2"
        description=""
      >
        <b-form-input
          id="input-2"
          v-model="form.username"
          type="text"
          required
          placeholder="Entrez votre prénom"
        ></b-form-input>
      </b-form-group>

<b-form @submit="onSubmit" @reset="onReset" v-if="show">
      <b-form-group
        id="input-group-3"
        label="Email address:"
        label-for="input-3"
        description=""
      >
        <b-form-input
          id="input-3"
          v-model="form.email"
          type="email"
          required
          placeholder="Entrer une adresse email"
          :state="validationEmail"
        ></b-form-input>
        <b-form-invalid-feedback :state="isEmailUse" >
                E mail deja utilisé ! 
        </b-form-invalid-feedback>
      <b-form-valid-feedback :state="isEmailUse">
                Adresse email disponible
      </b-form-valid-feedback>
      </b-form-group>

      <b-form-group
        id="input-group-4"
        label="Date de naissance"
        label-for="input-4"
        description=""
        
      >
        <b-form-input
          id="input-4"
          v-model="form.date_naissance"
          type="date"
          required
        ></b-form-input>
      </b-form-group>

      <div>
  <b-card bg-variant="light">
    <b-form-group
      label-cols-lg="3"
      label="Shipping Address"
      label-size="lg"
      label-class="font-weight-bold pt-0"
      class="mb-0"
    >
      <b-form-group
        label-cols-sm="3"
        label="Street:"
        label-align-sm="right"
        label-for="nested-street"
      >
        <b-form-input id="nested-street"></b-form-input>
      </b-form-group>

      <b-form-group
        label-cols-sm="3"
        label="City:"
        label-align-sm="right"
        label-for="nested-city"
      >
        <b-form-input id="nested-city"></b-form-input>
      </b-form-group>

      <b-form-group
        label-cols-sm="3"
        label="State:"
        label-align-sm="right"
        label-for="nested-state"
      >
        <b-form-input id="nested-state"></b-form-input>
      </b-form-group>

      <b-form-group
        label-cols-sm="3"
        label="Country:"
        label-align-sm="right"
        label-for="nested-country"
      >
        <b-form-input id="nested-country"></b-form-input>
      </b-form-group>
    </b-form-group>
  </b-card>
</div>
      <b-form-group
        id="input-group-5"
        label="Ville:"
        label-for="input-5"
        description=""
        
      >
        <b-form-input
          id="input-5"
          v-model="form.ville"
          type="text"
          required
          placeholder="Entrez votre ville"
        ></b-form-input>
      </b-form-group>

      <b-form-group
        id="input-group-12"
        label="Code Postale"
        label-for="input-12"
        description=""
        
      >
        <b-form-input
          id="input-12"
          v-model="form.codePostale"
          required
           pattern="[0-9]{5}"
          title="XXXXX"
          
        ></b-form-input>
      </b-form-group>


      <b-form-group
        id="input-group-13"
        label="Pays :"
        label-for="input-13"
        description=""
        
      >
        <b-form-select
          id="input-13"
          v-model="form.pays"
          :options="pays"
          required
        ></b-form-select>
      </b-form-group>

      <b-form-group
        id="input-group-6"
        label="Adresse de livraison:"
        label-for="input-6"
        description=""
        
      >
        <b-form-input
          id="input-6"
          v-model="form.adresse"
          type="text"
          required
          placeholder="Entrez votre adresse de livraison"
        ></b-form-input>
      </b-form-group>

      <b-form-group
        id="input-group-7"
        label="Numéro de téléphone:"
        label-for="input-7"
        description=""
        
      >
        <b-form-input
          id="input-7"
          v-model="form.telephone"
          type="tel"
          required
          placeholder="Entrez votre numéro de téléphone"
          pattern="[0]{1}[1-9]{1}[0-9]{8}"
          title="0XXXXXXXXX"
        ></b-form-input>
      </b-form-group>


      <b-form-group id="input-group-8" label="Password :" label-for="input-8">
        <b-form-input
          id="input-8"
          v-model="form.password"
          type="password"
          required
        ></b-form-input>
        <b-form-invalid-feedback :state="validationRegex">
        Le mot de passe doit contenire au moins une minuscule, une majuscule,
         un caractere special, 8 caracteres et un chiffre !
        </b-form-invalid-feedback>
      <b-form-valid-feedback :state="validationRegex">
        Pas mal
      </b-form-valid-feedback> 
      </b-form-group>
     
      <b-form-group id="input-group-9" label=" Confirm Password :" label-for="input-9">
        <b-form-input
          id="input-9"
          type="password"
          v-model="form.confirmPassword"
          :state="validationSamePassword"
          required
        ></b-form-input>
        <b-form-invalid-feedback :state="validationSamePassword">
       Les deux mots de passes doivent etre les memes !
      </b-form-invalid-feedback>
      <b-form-valid-feedback :state="validationSamePassword">
        C'est en effet le meme
      </b-form-valid-feedback>
      </b-form-group>


    <b-form-group label="Carte de crédit">
      <div>
  <b-input-group           
  prepend="Type de Carte Bancaire"
>
        <b-form-select
          id="input-14"
          v-model="form.typeCb"
          :options="typeCb"
          required
        ></b-form-select>
  </b-input-group>
      <b-input-group size="sm" prepend="Numéro de la carte">
        <b-form-input
        id="input-10"
          v-model="form.numero"
          type="text"
          pattern="[0-9]{16}"
          title="XXXXXXXXXXXXXXXX"
          required
          ></b-form-input>
      </b-input-group>
      
      
        <b-form inline >
          <b-input-group size="sm" prepend="Date de validée">
            <b-form-input
            id="input-11"
              v-model="form.date_validite"
              type="text"
              required
               pattern="[0-9]{2}/[0-9]{2}"
                title="XX/XX"
              ></b-form-input>
          </b-input-group>

          <b-input-group size="sm" prepend="Cryptogramme">
            <b-form-input
            id="input-15"
              v-model="form.crypto"
              type="text"
              required
               pattern="[0-9]{3}"
          title="XXX"
              ></b-form-input>
          </b-input-group>
        </b-form>
      

    </div>
    </b-form-group>
     
     <b-form-group style="margin-left: 35%;" label="Quel sera votre utilisation de notre site ? ">
          <b-form-radio-group
            v-model="selected"
            :options="options"
            buttons
            button-variant="outline-primary"
            size="lg"
            name="radio-btn-outline"
            style="margin-left: 5%;"
          ></b-form-radio-group>
    </b-form-group>

      <b-button type="submit" variant="primary" size="lg" style="margin-left:40%;">Submit</b-button>
      <b-button type="reset" variant="danger" size="lg">Reset</b-button>
    
    </b-form>
  </div>
</template>

<script>
    import axios from 'axios'
  export default {
    data() {
      return {
        selected: 'first',
        typeCb : ['MasterCard','Visa'],
        pays: [
          { text: 'France metropolitaine', value: 'France metropolitaine'},
          { text: 'France dom tom', value: 'France dom tom'},
          { text: 'Belgique', value: 'Belgique'},
        ],
        options: [
          { text: 'Acheteur', value: 'A'},
          { text: 'Vendeur', value: 'V'},
        ],
        form: {
          username: '',
          userlastname: '',
          email: '',
          telephone: '',
          password: '',
          confirmPassword : '',
          date_naissance : '',
          ville : '',
          adresse : '',
          numero : '',
          crypto : '',
          date_validite :'',
          codePostale: '',
          typeCb : null,
          pays: ''
        },
        show: true,
        isSamePassword: false,
        isEmailUse:false,
        regex : RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})"),
        regexTel : RegExp("[0-9]{3}"),
      }
    },


    methods: {

      onSubmit(evt) {
        evt.preventDefault()
        var self = this;
        console.log(new Date(this.form.date_naissance));
        if(this.validation1()  && this.isEmailUse){
       axios({
        method: 'post',
        url: '/register/user',
        data: {
          userlastname: self.form.userlastname,
          username: self.form.username,
          email: self.form.email,
          telephone: self.form.telephone,
          password: self.form.password,
          date_naissance : self.form.date_naissance,
          ville: self.form.ville,
          adresse: self.form.adresse,
          typeCb : self.form.typeCb,
          codePostale : self.form.codePostale,
          pays : self.form.pays,
          dateValidite : self.form.date_validite,
          numero  : self.form.numero,
          crypto : self.form.crypto,

        }
          }).then(function (response) {
           self.$router.push('/home'); 
          })
          .catch(function (error) {
          console.log(error);
        })
      }       
      },
      onReset(evt) {
        evt.preventDefault()
        // Reset our form values
        this.form.userlastname = ''
        this.form.username = ''
        this.form.email = ''
        this.form.telephone = ''
        this.form.password = ''
        this.form.confirmPassword=''
        this.form.date_naissance=''
        this.form.ville=''
        this.form.adresse=''
        this.form.numero=''
        this.form.crypto='',
        this.form.date_validite=''
        this.show = false
        this.$nextTick(() => {
          this.show = true
        })
      }, validation1(){
          return (this.form.password == this.form.confirmPassword) && ( this.form.password !="" );
      },
      validation2(){
        return this.regex.test(this.form.password);
      },
      validation3(){
      var self= this;
      var isUse;
        axios({
        method: 'get',
        url: '/check/user/mail',
        data: {
          email: self.form.email,
        }
          }).then(function (response) {
             self.isUse = response.data;
          })
          return self.isUse;
    }
    },
    computed : {
      validationSamePassword(){
          return (this.form.password == this.form.confirmPassword) && ( this.form.password !="" );
      },
      validationRegex(){
        return this.regex.test(this.form.password);
      },
      validationTel(){
        return this.regexTel.test(this.form.telephone);
      },
      validationEmail(){
      var self= this;
      var isUse = true;
        axios({
        method: 'post',
        url: '/check/user/mail',
        data: {
          email: self.form.email,
        }
          }).then(function (response) {
             self.isEmailUse = response.data;
          })          
    }
    }
    }
</script>

