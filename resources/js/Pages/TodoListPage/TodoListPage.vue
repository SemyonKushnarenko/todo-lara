<template>
  <BackButton :name="routes.main"/>
  <section
      class="todo-list"
      v-if="todoList"
  >
      <div class="todo-list__header">
        <input
            v-if="editMode"
            type="text"
            v-model="todoList.title"
            class="input"
        />
        <p v-else class="todo-list__description text">{{ todoList.title }}</p>
        <textarea
            v-if="editMode"
            v-model="todoList.description"
            class="textarea"
        ></textarea>
        <p v-else class="todo-list__title subtext">{{ todoList.description }}</p>
      </div>
      <div
          class="link medium-text"
          @click="editList"
      >{{ editMode ? 'Save' : 'Edit' }}</div>
      <div class="todo-list__todos">
        <div class="todos__header text">Todos:</div>
        <ul class="todos__list list">
          <li
              v-for="todo in todoList.todos"
              :key="todo.id"
              class="todo">
            <p
                class="todo__title"
                :class="{done: todo.is_done}"
            >{{ todo.title }}</p>
            <input
                type="checkbox"
                :id="todo.id"
                :checked="todo.is_done"
                @click="() => toggleDone(todo)"
            >
          </li>
        </ul>
      </div>
  </section>
</template>

<script>
import TodoListService from '../../services/TodoListService';
import TodoService from '../../services/TodoService';
import {defineAsyncComponent} from 'vue';
import BackButton from "../../components/Buttons/BackButton/BackButton";
import RouteNames from "../../router/RouteNames";

const todoListService = new TodoListService();
const todoService = new TodoService();

export default {
  name: 'TodoListPage',
  components: {
    BackButton,
    TodoList: defineAsyncComponent(() =>
      import('../../components/TodoList/TodoList'),
    ),
  },
  props: {
    todoListId: {
      type: String,
      required: true,
    }
  },
  data() {
    return {
      todoList: null,
      routes: RouteNames,
      editMode: false,
    };
  },
  mounted() {
    this.getList();
  },
  methods: {
    getList() {
      todoListService.getTodoList(window.Laravel.user.id, this.todoListId)
        .then(res => {
          this.todoList = res.data.data;
        });
    },
    updateTodo(todoId, newTodo) {
      todoService.updateTodo(todoId, newTodo, window.Laravel.user.id)
          .then(res => console.log(res))
          .catch(error => console.log(error));
    },
    toggleDone(todo) {
      todo.is_done = !todo.is_done;
      this.updateTodo(todo.id, todo);
    },
    editList() {
      if (this.editMode) {
        return todoListService.updateTodoList(window.Laravel.user.id, this.todoListId, this.todoList)
            .then(() => {
              this.editMode = !this.editMode;
            })
            .catch(error => console.log(error));
      }
      this.editMode = !this.editMode;
    },
  },
};
</script>

<style lang="scss">
@import '../../../sass/components/todolist';
</style>