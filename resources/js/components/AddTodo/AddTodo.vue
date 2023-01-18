<template>
  <div class="add-todo">
    <input
        type="text"
        v-model="title"
        class="input add-todo__input"
    />
    <AddButton
        note="ADD"
        @click="createTodo"
        class-names="link"
    />
  </div>
</template>

<script>
import AddButton from "../Buttons/AddButton/AddButton";
import TodoService from '../../services/TodoService';

const todoService = new TodoService();

export default {
  name: "AddTodo",
  components: {AddButton},
  props: {
    todoListId: {
      type: Number,
      required: true,
    },
  },
  data() {
    return {
      title: ''
    };
  },
  methods: {
    createTodo() {
      todoService.addTodo(this.todoListId, this.title, window.Laravel.user.id)
          .then(() => this.$emit('addTodo'))
          .catch(error => console.log(error));
    },
  },
}
</script>

<style lang="scss">
@import 'resources/sass/components/add-todo';
</style>