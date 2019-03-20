<template>
  <div id="app">
    <!-- <img src="./assets/logo.png"> -->
    <Navigation></Navigation>
    <router-view/>
  </div>
</template>

<script>

import HeaderNav from '@/components/Includes/Nav';

export default {
  name: 'App',
  components:{
    'Navigation': HeaderNav,
  },
}
</script>

<style>
/* #app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
} */
</style>
