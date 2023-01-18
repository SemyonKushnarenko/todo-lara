<template>
  <section class="todo-lists">
    <div class="todo-lists__header">
      <p class="todo-lists__title text">
        Hello, {{ user?.name }}! Here are your {{ lists?.length }} lists
      </p>
    </div>
    <ul
        v-if="lists"
        class="todo-lists__list"
    >
      <p v-if="!lists.length">You have no lists. Let's add the first one</p>
      <TodoList
        v-for="list in lists"
        :key="list.id"
        :list="list"
      />
      <AddTodoList
          v-if="addMode"
          @todoListAdded="todoListAdded"
      />
      <AddButton
          v-else
          note="Add todo list"
          class-names="text link"
          @click="addMode = true"
      />
    </ul>
  </section>
</template>

<script>
import UserService from '../../services/UserService';
import {defineAsyncComponent} from 'vue';
import AddButton from "../../components/Buttons/AddButton/AddButton";
import AddTodoList from "../../components/AddTodoList/AddTodoList";

const todoListService = new UserService();

export default {
  name: 'MainPage',
  components: {
    AddTodoList,
    AddButton,
    TodoList: defineAsyncComponent(() =>
      import('../../components/TodoList/TodoList'),
    ),
  },
  data() {
    return {
      user: window.Laravel.user,
      lists: null,
      addMode: false,
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
        })
        .catch(err => {
          this.lists = [];
        });
    },
    todoListAdded() {
      this.addMode = false;
      this.getList(this.user.id);
    }
  },
};
</script>

<style lang="scss">
@import '../../../sass/components/todolists';
</style>