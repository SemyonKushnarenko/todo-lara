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
    >Login</button>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: 'LoginComponent',
  data() {
     return {
       email: null,
       password: null,
     }
  },
  methods: {
    login() {
      axios.get('/sanctum/csrf-cookie').then(() => {
        axios.post('/login', {
          email: this.email,
          password: this.password,
        }).then(() => {
          this.$router.push({
            name: 'main'
          });
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