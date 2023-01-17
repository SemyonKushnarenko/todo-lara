import axios from 'axios';

export default class TodoListService {
    url = '/api/user/';

    async getTodoList(userId, todoListId) {
        return await axios.get(`${this.url}${userId}/todo-list/${todoListId}`);
    }

    async updateTodoList(userId, todoListId, newTodoList) {
        return await axios.patch(
            `${this.url}${userId}/todo-list/${todoListId}`,
            newTodoList
        );
    }
}