import axios from 'axios';

export default class UserService {
    url = '/api/user/';

    async getAllTodoListsByUser(userId) {
        return await axios.get(`${this.url}${userId}/todo-lists`);
    }
}