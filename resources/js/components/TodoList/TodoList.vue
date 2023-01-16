<template>
  <li class="todo-list-wrapper">
    <div class="todo-list">
      <p class="todo-list__title">
        {{ list.title }}
      </p>
      <div class="todo-list__actions">
        <div class="action">
          E
        </div>
        <div class="action">
          D
        </div>
        <div class="action">
          ia
        </div>
      </div>
    </div>
    <ul class="todos">
      <li class="todo">
        <div class="todo__description">
          <p class="todo__title">
            User 1
          </p>
        </div>
        <div class="todo__actions">
          <div class="action">
            E
          </div>
          <div class="action">
            D
          </div>
        </div>
      </li>
      <li class="todo">
        <div class="todo__description">
          <p class="todo__title">
            User 1
          </p>
        </div>
        <div class="todo__actions">
          <div class="action">
            E
          </div>
          <div class="action">
            D
          </div>
        </div>
      </li>
    </ul>
  </li>
</template>

<script>
export default {
  name: 'TodoList',
  props: {
    list: {
      type: Object,
      required: true,
    },
  },
};
</script>

<style scoped>

</style>