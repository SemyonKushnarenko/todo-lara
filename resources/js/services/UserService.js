import axios from 'axios';

export default class UserService {
    url = '/api/user/';

    getAllTodoListsByUser(userId) {
        return axios.get(`${this.url}${userId}/todo-lists`);
    }
}