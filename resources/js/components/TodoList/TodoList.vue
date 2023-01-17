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
      <router-link :to="{
        name: routes.todoListPage,
        params: {
          todoListId: list.id
        },
      }" class="link">
        Go to
      </router-link>
    </div>
  </li>
</template>

<script>
import RouteNames from "../../router/RouteNames";

export default {
  name: 'TodoList',
  data() {
    return {
      routes: RouteNames,
    };
  },
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