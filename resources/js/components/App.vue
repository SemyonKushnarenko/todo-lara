<template>
  <HeaderComponent :token="token" />
  <main class="main">
    <div class="container container_main">
      <router-view />
    </div>
  </main>
</template>

<script>
import HeaderComponent from './Header/HeaderComponent';

export default {
  name: 'App',
  components: {HeaderComponent},
  data() {
    return {
      token: null,
    };
  },
  watch:{
    $route() {
      this.getToken();
    },
  },
  mounted() {
    this.getToken();
  },
  methods: {
    getToken() {
      this.token = localStorage.getItem('x-xsrf-token');
    },
  },
};
</script>

<style lang="scss">
@import 'resources/sass/app';
</style>