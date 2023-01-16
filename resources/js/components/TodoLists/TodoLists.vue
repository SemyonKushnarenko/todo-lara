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
    <ul
      v-if="lists"
      class="todo-lists__list"
    >
      <TodoList
        v-for="list in lists"
        :key="list.id"
        :list="list"
      />
    </ul>
  </section>
</template>

<script>
import UserService from '../../services/UserService';
import {defineAsyncComponent} from 'vue';

const todoListService = new UserService();

export default {
  name: 'TodoLists',
  components: {
    TodoList: defineAsyncComponent(() =>
      import('../TodoList/TodoList'),
    ),
  },
  data() {
    return {
      user: window.Laravel.user,
      lists: null,
    };
  },
  mounted() {
    this.getList(this.user.id);
  },
  methods: {
    getList(userId) {
      todoListService.getAllTodoListsByUser(userId)
        .then(res => {
          this.lists = res.data.data;
        });
    },
  },
};
</script>

<style lang="scss">
@import 'resources/sass/components/list-of-todolists';
</style>