<template>
    <div>
        <headerup></headerup>
        <div class="container">
            <router-view/>
        </div>
        <footerdown></footerdown>
    </div>    
</template>

<script>
import headerup from './header-up.vue'; // Import the Header component
import footerdown from './footer-down.vue';
import 'bootstrap-icons/font/bootstrap-icons.css';

export default {
  name: 'App',
  components: {
    headerup,// Register the Header component
    footerdown, 
  },
};

</script>

<style>
h4{
  margin-bottom: 20px;
  margin-top: 50px;

}</style>