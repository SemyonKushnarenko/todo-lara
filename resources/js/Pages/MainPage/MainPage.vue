<template>
  <section class="todo-lists">
    <div class="todo-lists__header">
      <p class="todo-lists__title text">
        Hello, {{ user?.name }}! Here are your {{ lists?.length || 0 }} lists
      </p>
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
  name: 'MainPage',
  components: {
    TodoList: defineAsyncComponent(() =>
      import('../../components/TodoList/TodoList'),
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
@import '../../../sass/components/todolists';
</style>