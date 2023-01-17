<template>
  <p class="link medium-text">{{ editMode ? 'Save' : 'Edit' }}</p>
</template>

<script>
export default {
  name: 'EditButton',
  props: {
    editMode: {
      type: Boolean,
      required: true,
    },
  },
};
</script>

<style lang="scss">
@import "resources/sass/components/back_button.scss";
</style>