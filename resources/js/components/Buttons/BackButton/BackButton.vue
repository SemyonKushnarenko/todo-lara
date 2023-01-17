<template>
  <div class="redirect--general">
    <div
      class="back"
      @click="goBack"
    >
      <svg
        width="5.25"
        height="10"
        viewBox="0 0 8 12"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          d="M7 1L1.75 6L7 11"
          stroke="#191B1D"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
        />
      </svg>
    </div>
  </div>
</template>

<script>
import RouteNames from "../../../router/RouteNames";

export default {
  name: 'BackButton',
  props: {
    name: {
      type: String,
      default: RouteNames.main,
    },
    params: {
      type: Object,
      default() {
        return {};
      },
    },
  },
  methods: {
    goBack() {
      this.$router.push({
        name: this.name,
        params: this.params,
      });
    },
  },
};
</script>

<style lang="scss">
@import "resources/sass/components/back_button.scss";
</style>