<template>
  <div class="add-todo-list">
    <div class="column">
      <label
          class="bold"
          for="title">Title:</label>
      <input
          id="title"
          type="text"
          v-model="title"
          class="input"
      />
    </div>
    <div class="column">
      <label
          class="bold"
          for="description">Description:</label>
      <textarea
          id="description"
          v-model="description"
          class="textarea"
      ></textarea>
    </div>
    <AddButton
        note="ADD"
        @click="createTodoList"
        :class-names="link"
    />
  </div>
</template>

<script>
import AddButton from "../Buttons/AddButton/AddButton";
import TodoListService from '../../services/TodoListService';

const todoListService = new TodoListService();

export default {
  name: "AddTodoList",
  components: {AddButton},
  data() {
    return {
      title: '',
      description: '',
    };
  },
  methods: {
    createTodoList() {
      todoListService.addTodoList(
          {
            title: this.title,
            description: this.description,
          },
          window.Laravel.user.id
      )
          .then(() => this.$emit('todoListAdded'))
          .catch(error => console.log(error));
    },
  },
}
</script>

<style lang="scss">
@import 'resources/sass/components/add-todo-list';
</style>