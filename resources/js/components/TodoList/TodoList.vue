<template>
  <li class="todo-list-wrapper">
    <div class="todo-list">
      <div class="todo-list__description">
        <p class="todo-list__title">
          {{ list.title }}
        </p>
        <p class="todo-list__subtitle">
          {{ list.description }}
        </p>
      </div>
      <div class="actions">
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
      <Todo
          v-for="todo in list.todos"
          :key="todo.id"
          :todo="todo"
      />
    </ul>
  </li>
</template>

<script>
import Todo from "../Todo/Todo";

export default {
  name: 'TodoList',
  components: {Todo},
  props: {
    list: {
      type: Object,
      required: true,
    },
  },
};
</script>

<style lang="scss">
@import 'resources/sass/components/todolist';
</style>