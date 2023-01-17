<template>
<div class="add">+ {{note}}</div>
</template>

<script>
export default {
  name: "AddButton",
  props: {
    note: {
      type: String,
      required: true,
    }
  }
}
</script>

<style lang="scss">
@import "resources/sass/components/add_button.scss";
</style>