<template>
  <formAddProduct></formAddProduct>
</template>


<script>
    import FormAddProduct from '../components/FormAddProduct.vue';
    export default {
        name: 'addProduct',
        components :{
        formAddProduct : FormAddProduct,
        },
         data () {
          return {
            
          }
          
        },
    }
</script>