<template>
  <div class="container">
    <div class="header">
      <router-link :to="{ name: this.routes.login }">Login</router-link>
      <router-link :to="{ name: this.routes.registration }">Register</router-link>
      <a
          href="#"
          @click.prevent="logout"
      >Logout</a>
    </div>
    <router-view></router-view>
  </div>
</template>

<script>
import RouteNames from "../router/RouteNames";
import axios from 'axios';
export default {
  name: 'App',
  data() {
    return {
      routes: RouteNames
    }
  },
  methods: {
    logout() {
      axios.post('/logout').then(() => {
        this.$router.push({
          name: this.routes.login,
        });
      })
    }
  }
};
</script>

<style lang="scss">
@import 'resources/sass/app';
@import 'resources/sass/partials/header';
</style>