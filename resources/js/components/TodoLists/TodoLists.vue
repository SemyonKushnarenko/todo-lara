<template>
  <p class="text">Hello, {{user.name}}!</p>
</template>

<script>
export default {
  name: 'TodoLists',
  data() {
    return {
      user: window.Laravel.user,
    };
  },
}
</script>

<style scoped>

</style>