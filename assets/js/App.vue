<template>
    <div class="container">
        <navBar></navBar>  
        <router-view></router-view>
    </div>
</template>

<script>
    import NavBar from './components/NavBar';

    export default {
        name: 'app',
        components :{
             navBar : NavBar
        }
    }
</script>