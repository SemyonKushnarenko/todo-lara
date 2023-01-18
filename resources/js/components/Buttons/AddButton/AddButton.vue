<template>
  <div
      :class="classNames"
  >+ {{ note }}</div>
</template>

<script>
export default {
  name: "AddButton",
  props: {
    note: {
      type: String,
      required: true,
    },
    classNames: {
      type: String,
      default: '',
    },
  }
}
</script>