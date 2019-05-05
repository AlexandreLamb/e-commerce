<template>
    <div>
        
        <form-add-product></form-add-product>
            
    </div>
  
</template>


<script>
    import FormAddProduct from '../components/FormAddProduct.vue';
    import { isNullOrUndefined } from 'util';

    export default {
        name: 'addProduct',
        components :{
        formAddProduct : FormAddProduct,
        },
         data () {
          return {
            user : isNullOrUndefined(localStorage.user) ? null : JSON.parse(localStorage.user)
          }
          
        },
    }
</script>