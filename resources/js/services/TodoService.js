import axios from 'axios';

export default class TodoService {
    url = '/api/todo/';

    async updateTodo(todoId, newTodo, userId) {
        return await axios.patch(`${this.url}${todoId}`, {
            ...newTodo,
            user_id: userId
        });
    }
}