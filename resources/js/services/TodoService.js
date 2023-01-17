import axios from 'axios';

export default class TodoService {
    url = '/api/todo-list/';

    async addTodo(todoListId, title, userId) {
        return await axios.post(`${this.url}${todoListId}/todo`, {
            title,
            user_id: userId
        });
    }

    async updateTodo(todoListId, newTodo, userId) {
        return await axios.patch(`${this.url}${todoListId}/todo/${newTodo.id}`, {
            ...newTodo,
            user_id: userId
        });
    }

    async deleteTodo(todoListId, todoId, userId) {
        return await axios.delete(`${this.url}${todoListId}/todo/${todoId}`, {
            data: {user_id: userId}
        });
    }
}