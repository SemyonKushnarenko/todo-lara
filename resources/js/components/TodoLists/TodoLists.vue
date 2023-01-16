<template>
  <section class="todo-lists">
    <div class="todo-lists__header">
      <p class="todo-lists__title text">
        Hello, {{ user.name }}! Here are your lists
      </p>
      <div class="todo-lists__count">
        335
      </div>
    </div>
    <ul class="todo-lists__list">
      <TodoList />
      <TodoList />
    </ul>
  </section>
</template>

<script>
import TodoList from '../TodoList/TodoList';

export default {
  name: 'TodoLists',
  components: {TodoList},
  data() {
    return {
      user: window.Laravel.user,
    };
  },
};
</script>

<style lang="scss">
@import 'resources/sass/components/list-of-todolists';
</style>