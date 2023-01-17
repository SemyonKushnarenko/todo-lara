<template>
  <p class="welcome">
    Hello, stranger! Here you can manage your todo-lists. Please,
    <router-link :to="{name: routes.login}">
      log in
    </router-link> and try it!!!
  </p>
</template>

<script>
import RouteNames from '../../router/RouteNames';
export default {
  name: 'WelcomePage',
  data() {
    return {
      routes: RouteNames,
    };
  },
};
</script>

<style lang="scss">
@import '../../../sass/components/welcome';
</style>