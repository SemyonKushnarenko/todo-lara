<template>
  <Header :token="token" />
  <main class="main">
    <div class="container container_main">
      <router-view></router-view>
    </div>
  </main>
</template>

<script>
import Header from "./Header/Header";

export default {
  name: 'App',
  components: {Header},
  data() {
    return {
      token: null,
    };
  },
  mounted() {
    this.getToken();
  },
  watch:{
    $route() {
      this.getToken();
    },
  },
  methods: {
    getToken() {
      this.token = localStorage.getItem('x-xsrf-token');
    }
  },
};
</script>

<style lang="scss">
@import 'resources/sass/app';
</style>