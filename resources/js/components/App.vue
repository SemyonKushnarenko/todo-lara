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
import RouteNames from "../router/RouteNames";

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
  created() {
    this.getToken();
    if (!window.Laravel.user) {
      this.$router.push({name: RouteNames.login})
    }
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
@import 'resources/sass/components/actions';
</style>