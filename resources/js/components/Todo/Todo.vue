<template>
  <li class="todo">
    <Spinner v-if="loading" />
    <div v-else class="todo__description">
      <input
          v-if="editMode"
          type="text"
          v-model="newTitle"
          class="todo__input"
      />
      <p v-else class="todo__title">
        {{ newTitle }}
      </p>
    </div>
    <div class="actions">
      <div v-if="editMode" @click="updateTodo" class="action">
        V
      </div>
      <div v-else class="action" @click="editMode = true">
        E
      </div>
      <div class="action">
        D
      </div>
    </div>
  </li>
</template>

<script>
import TodoService from '../../services/TodoService';
import Spinner from "../Spinner/Spinner";
const todoService = new TodoService();

export default {
  name: "Todo",
  components: {Spinner},
  props: {
    todo: {
      type: Object,
      required: true,
    }
  },
  data() {
    return {
      editMode: false,
      newTitle: this.todo.title,
      loading: false,
      error: false,
    };
  },
  methods: {
    updateTodo() {
      this.editMode = true;
      this.loading = true;
      todoService.updateTitle(this.todo.id, this.newTitle)
          .then(res => {
            this.loading = false;
          })
          .catch(err => {
            this.error = true;
          });
    }
  },
}
</script>

<style lang="scss">
@import 'resources/sass/components/todo';
</style>