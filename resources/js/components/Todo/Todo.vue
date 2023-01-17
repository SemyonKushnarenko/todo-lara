<template>
  <li class="todo">
    <input
        v-if="editMode"
        type="text"
        v-model="newTodo.title"
        class="input todo__input"
    />
    <p
      v-else
      class="todo__title"
      :class="{done: newTodo.is_done}"
    >{{ newTodo.title }}</p>
    <div class="actions">
      <div class="checkbox-wrapper">
        <label :for="newTodo.id">done</label>
        <input
            type="checkbox"
            :id="newTodo.id"
            :checked="newTodo.is_done"
            @click="() => toggleDone(newTodo)"
        >
      </div>
      <EditButton
          @click="() => editTodo(newTodo)"
          :edit-mode="editMode"
      />
      <DeleteButton @remove="deleteTodo"/>
    </div>
  </li>
</template>

<script>
import TodoService from '../../services/TodoService';
import Spinner from "../Spinner/Spinner";
import EditButton from "../Buttons/EditButton/EditButton";
import DeleteButton from "../Buttons/DeleteButton/DeleteButton";
const todoService = new TodoService();

export default {
  name: "Todo",
  components: {DeleteButton, EditButton, Spinner},
  props: {
    todo: {
      type: Object,
      required: true,
    },
    todoListId: {
      type: Number,
      required: true,
    },
  },
  data() {
    return {
      editMode: false,
      newTodo: {...this.todo},
      loading: false,
      error: false,
    };
  },
  methods: {
    updateTodo(todoId, newTodo) {
      return todoService.updateTodo(this.todoListId, newTodo, window.Laravel.user.id)
          .then(res => console.log(res))
          .catch(error => console.log(error));
    },
    toggleDone(todo) {
      todo.is_done = !todo.is_done;
      this.updateTodo(todo.id, todo);
    },
    editTodo(todo) {
      if (this.editMode && (this.todo.title !== this.newTodo.title)) {
        return this.updateTodo(todo.id, todo)
            .then(() => {
              this.editMode = !this.editMode;
            })
            .catch(error => console.log(error));
      }
      this.editMode = !this.editMode;
    },
    deleteTodo() {
      todoService.deleteTodo(this.todoListId, this.todo.id, window.Laravel.user.id)
          .then(res => this.$emit('remove'))
          .catch(error => console.log(error));
    },
  },
}
</script>

<style lang="scss">
@import 'resources/sass/components/todo';
</style>