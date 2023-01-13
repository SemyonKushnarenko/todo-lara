<template>

</template>

<script>
export default {
  name: "MainPage",
  mounted() {
    this.getData();
  },
  methods: {
    getData() {
      axios.get('/api/main').then((res) => {
        console.log(res)
          })
    }
  }
}
</script>

<style scoped>

</style>