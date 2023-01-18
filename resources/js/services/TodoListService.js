import axios from 'axios';

export default class TodoListService {
    url = '/api/user/';

    async getTodoList(userId, todoListId) {
        return await axios.get(`${this.url}${userId}/todo-list/${todoListId}`);
    }

    async exportTodoList(userId, todoListId) {
        return await axios.get(`${this.url}${userId}/todo-list/${todoListId}/export`, {
            responseType: 'blob',
        });
    }

    async addTodoList(data, userId) {
        return await axios.post(`${this.url}${userId}/todo-list`, data);
    }

    async updateTodoList(userId, todoListId, newTodoList) {
        return await axios.patch(
            `${this.url}${userId}/todo-list/${todoListId}`,
            newTodoList
        );
    }

    async deleteTodoList(userId, todoListId) {
        return await axios.delete(`${this.url}${userId}/todo-list/${todoListId}`);
    }
}