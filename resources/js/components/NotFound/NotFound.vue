<template>
  <div class="not-found">
    <p class="text">Sorry, page doesn't exists</p>
    <router-link
        class="not-found__link"
        :to="{name: routes.lists}"
    >
      <button
          class="not-found__get-back"
      >Get to home</button>
    </router-link>
  </div>
</template>

<script>
import RouteNames from "../../router/RouteNames";
export default {
  name: "NotFound",
  data() {
    return {
      routes: RouteNames,
    };
  },
}
</script>

<style lang="scss">
@import 'resources/sass/components/404';
</style>