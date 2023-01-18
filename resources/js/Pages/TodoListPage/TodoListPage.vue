<template>
  <BackButton :name="routes.main"/>
  <section
      class="todo-list"
      v-if="todoList"
  >
      <div class="todo-list__header">
        <div class="column" v-if="editMode">
          <label
              class="bold"
              for="title">Title:</label>
          <input
              id="title"
              type="text"
              v-model="todoList.title"
              class="input"
          />
        </div>
        <p v-else class="todo-list__title text">{{ todoList.title }}</p>
        <div class="column" v-if="editMode">
          <label
              class="bold"
              for="description">Description:</label>
          <textarea
              id="description"
              v-model="todoList.description"
              class="textarea"
          ></textarea>
        </div>
        <p v-else class="todo-list__description subtext">{{ todoList.description }}</p>
      </div>
    <div class="actions">
      <EditButton
          @click="editList"
          :edit-mode="editMode"
      />
      <DeleteButton
          @remove="removeList"
      />
    </div>
      <div class="todos">
        <div class="todos__header text">Todos:</div>
        <ul class="todos__list list">
          <Todo
              v-for="todo in todoList.todos"
              :todo="todo"
              :key="todo.id"
              :todo-list-id="todoList.id"
              @remove="getList"
          />
          <p v-if="!todos.length">There is no todo. Create your first</p>
          <AddTodo
              v-if="addMode"
              @todoAdded="todoAdded"
              :todo-list-id="todoList.id"
          />
          <AddButton
              v-else
              note="Add Todo"
              class-names="link"
              @click="addMode = true"
          />
        </ul>
      </div>
  </section>
</template>

<script>
import TodoListService from '../../services/TodoListService';
import TodoService from '../../services/TodoService';
import BackButton from "../../components/Buttons/BackButton/BackButton";
import RouteNames from "../../router/RouteNames";
import Todo from "../../components/Todo/Todo";
import EditButton from "../../components/Buttons/EditButton/EditButton";
import AddButton from "../../components/Buttons/AddButton/AddButton";
import AddTodo from "../../components/AddTodo/AddTodo";
import DeleteButton from "../../components/Buttons/DeleteButton/DeleteButton";

const todoListService = new TodoListService();
const todoService = new TodoService();

export default {
  name: 'TodoListPage',
  components: {
    DeleteButton,
    AddTodo,
    AddButton,
    EditButton,
    Todo,
    BackButton,
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
      todos: null,
      addMode: false,
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
          this.todos = this.todoList.todos;
        });
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
    removeList() {
      todoListService.deleteTodoList(window.Laravel.user.id, this.todoListId)
          .then(() => {
            this.$router.push({name: RouteNames.main});
          })
          .catch(error => console.log(error));
    },
    todoAdded() {
      this.addMode = false;
      this.getList();
    },
  },
};
</script>

<style lang="scss">
@import '../../../sass/components/todolist';
</style>