<template>
  <div>
    <b-form @submit="onSubmit" @reset="onReset" v-if="show">
      <b-form-group
        id="input-group-1"
        label="Email address:"
        label-for="input-1"
        description=""
      >
        <b-form-input
          id="input-1"
          v-model="form.email"
          type="email"
          required
          placeholder="Entrer une adresse email"
          :state="validationEmail"
        ></b-form-input>
        <b-form-invalid-feedback :state="isEmailUse">
                E mail deja utilisé ! 
        </b-form-invalid-feedback>
      <b-form-valid-feedback :state="isEmailUse">
                Adresse email disponible
      </b-form-valid-feedback>
      </b-form-group>

      <b-form-group
        id="input-group-1"
        label="Nom d'utilisateur:"
        label-for="input-2"
        description=""
      >
        <b-form-input
          id="input-2"
          v-model="form.username"
          type="text"
          required
          placeholder="Entrez un nom d'utilisateur"
        ></b-form-input>
      </b-form-group>


      <b-form-group id="input-group-3" label="Password :" label-for="input-3">
        <b-form-input
          id="input-3"
          v-model="form.password"
          type="password"
          required
          :state="validationRegex"
        ></b-form-input>
        <b-form-invalid-feedback :state="validationRegex">
        Le mot de passe doit contenire au moins une minuscule, une majuscule,
         un caractere special, 8 caracteres et un chiffre !
        </b-form-invalid-feedback>
      <b-form-valid-feedback :state="validationRegex">
        Pas mal
      </b-form-valid-feedback>
        
      </b-form-group>
      <b-form-group id="input-group-4" label=" Confirm Password :" label-for="input-4">
        <b-form-input
          id="input-4"
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

      <b-button type="submit" variant="primary">Submit</b-button>
      <b-button type="reset" variant="danger">Reset</b-button>
    </b-form>
  </div>
</template>

<script>
    import axios from 'axios'
  export default {
    data() {
      return {
        form: {
          email: '',
          username: '',
          password: '',
          confirmPassword : ''
        },
        show: true,
        isSamePassword: false,
        isEmailUse:false,
        regex : RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})"),
      }
    },
    methods: {

      onSubmit(evt) {
        evt.preventDefault()
        var self = this;
        this.validationEmail();
        if(this.validation1() && this.validation2() && this.isEmailUse){
       axios({
        method: 'post',
        url: '/register/user',
        data: {
          email: self.form.email,
          username: self.form.username,
          password: self.form.password,
        }
          }).then(function (response) {
            this.$router.push('home'); 
          })
          .catch(function (error) {
          console.log(error);
        })
      }       
      },
      onReset(evt) {
        evt.preventDefault()
        // Reset our form values
        this.form.email = ''
        this.form.username = ''
        this.form.password = ''
        this.form.confirmPassword=''
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
      validationEmail(){
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