<template>
  <div class="inputs-container">
    <div class="input-container">
      <label
        class="label"
        for="name"
      >Name:</label>
      <input
        id="name"
        v-model="name"
        type="text"
        class="input"
        name="name"
        required
        autofocus
      >
    </div>
    <div class="input-container">
      <label
        class="label"
        for="email"
      >Email:</label>
      <input
        id="email"
        v-model="email"
        type="email"
        class="input"
        name="email"
        required
        autofocus
      >
    </div>
    <div class="input-container">
      <label
        class="label"
        for="password"
      >Password:</label>
      <input
        id="password"
        v-model="password"
        type="password"
        class="input"
        name="password"
        required
      >
    </div>
    <div class="input-container">
      <label
        class="label"
        for="password_confirmation"
      >Repeat your password:</label>
      <input
        id="password_confirmation"
        v-model="password_confirmation"
        type="password"
        class="input"
        name="password_confirmation"
        required
      >
    </div>
    <p
      v-if="error"
      class="error"
    >
      {{ errorMessage }}
    </p>
    <button
      type="button"
      class="button"
      @click="register"
    >
      Registration
    </button>
    <p class="to_login">
      Already have an account, you can
      <router-link
        :to="{name: routes.login}"
        class="link"
      >
        login
      </router-link>
    </p>
  </div>
</template>

<script>
import axios from 'axios';
import RouteNames from '../../router/RouteNames';

export default {
  name: 'RegistrationComponent',
  data() {
    return {
      name: null,
      email: null,
      password: null,
      password_confirmation: null,
      error: false,
      errorMessage: '',
      routes: RouteNames,
    };
  },
  methods: {
    register() {
      if (this.password !== this.password_confirmation) {
        this.error = true;
        this.errorMessage = 'Password and password repetition should be the same!';
        return;
      }
      axios.get('/sanctum/csrf-cookie').then(() => {
        axios.post('/register', {
          name: this.name,
          email: this.email,
          password: this.password,
          password_confirmation: this.password_confirmation,
        })
          .then((response) => {
            localStorage.setItem('x-xsrf-token', response.config.headers['X-XSRF-TOKEN']);
            this.$router.push({
              name: RouteNames.lists,
            });
          })
          .catch(error => {
            if (error.response.status === 422) {
              this.error = true;
              this.errorMessage = 'Please, input all the fields right';
            }
          });
      });
    },
  },
};
</script>

<style lang="scss">
@import 'resources/sass/components/inputs';
@import 'resources/sass/components/errors';
</style>