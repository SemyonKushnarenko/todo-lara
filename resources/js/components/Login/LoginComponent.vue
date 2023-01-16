<template>
  <div class="inputs-container">
    <div class="input-container">
      <label
          class="label"
          for="email">Email:</label>
      <input
          v-model="email"
          id="email"
          type="email"
          class="input"
          name="email"
          required
          autofocus>
    </div>
    <div class="input-container">
      <label
          class="label"
          for="password">Password:</label>
      <input
          v-model="password"
          id="password"
          type="password"
          class="input"
          name="password"
          required>
    </div>
    <button
        type="button"
        class="button"
        @click="login"
    >Login
    </button>
    <p class="to_register">If you have no account, <router-link
        :to="{name: routes.registration}"
        class="link"
    >register</router-link> first</p>
  </div>
</template>

<script>
import axios from "axios";
import RouteNames from "../../router/RouteNames";

export default {
  name: 'LoginComponent',
  data() {
    return {
      email: null,
      password: null,
      error: false,
      errorMessage: null,
      routes: RouteNames,
    };
  },
  methods: {
    login() {
      axios.get('/sanctum/csrf-cookie').then(() => {
        axios.post('/login', {
          email: this.email,
          password: this.password,
        })
            .then(res => {
              localStorage.setItem('x-xsrf-token', res.config.headers['X-XSRF-TOKEN']);
              this.$router.push({
                name: RouteNames.lists
              });
            })
            .catch(error => {
              if (error.response.status === 422) {
                this.error = true;
                this.errorMessage = 'Please, input right email and password, or try to register';
              }
            });
      })
    }
  }
}
</script>

<style lang="scss">
@import 'resources/sass/components/inputs';
@import 'resources/sass/components/errors';
</style>