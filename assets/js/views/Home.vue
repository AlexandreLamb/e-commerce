<template>
    <div>   
        <carousel></carousel>
        
    </div>
</template>

<script>
    import Carousel from '../components/Carousel.vue';
    export default {
        name: 'home',
        components :{
           carousel : Carousel,
        }
    }
</script>