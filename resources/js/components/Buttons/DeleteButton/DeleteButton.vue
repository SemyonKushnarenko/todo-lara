<template>
  <div class="actions" v-if="isPressed">
    <p>Are you sure?</p>
    <div
        class="link dark-text medium-text"
        @click="$emit('remove')"
    >Yes</div>
    <div
        class="link dark-text medium-text"
         @click="isPressed = false"
    >No</div>
  </div>
  <p
      v-else
      class="link dark-text medium-text"
      @click="isPressed = true"
  >Delete</p>
</template>

<script>
export default {
  name: 'DeleteButton',
  data() {
    return {
      isPressed: false,
    };
  },
};
</script>