<template>
  <header class="header">
    <div class="container container_header">
      <nav class="header__left-nav">
        <ul class="list">
          <li v-if="!token">
            <router-link
              class="header__link"
              :to="{
                name: routes.welcomePage
              }"
            >
              Home
            </router-link>
          </li>
          <li v-if="token">
            <router-link
              class="header__link"
              :to="{
                name: routes.main
              }"
            >
              My lists
            </router-link>
          </li>
        </ul>
      </nav>
      <nav class="header__right-nav">
        <ul class="list">
          <li v-if="token">
            <a
              class="header__link"
              href="#"
              @click.prevent="logout"
            >Logout</a>
          </li>
          <li v-if="!token">
            <router-link
              class="header__link"
              :to="{ name: routes.login }"
            >
              Login
            </router-link>
          </li>
          <li v-if="!token">
            <router-link
              class="header__link"
              :to="{ name: routes.registration }"
            >
              Registration
            </router-link>
          </li>
        </ul>
      </nav>
    </div>
  </header>
</template>

<script>
import RouteNames from '../../router/RouteNames';
import axios from 'axios';

export default {
  name: 'HeaderComponent',
  props: {
    token: {
      type: String,
      default: null,
    },
  },
  data() {
    return {
      routes: RouteNames,
    };
  },
  methods: {
    logout() {
      axios.post('/logout').then(() => {
        localStorage.removeItem('x-xsrf-token');
        this.$router.push({
          name: this.routes.login,
        });
      });
    },
  },
};
</script>

<style lang="scss">
@import 'resources/sass/partials/header';
</style>