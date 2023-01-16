import axios from 'axios';

export default class TodoService {
    url = '/api/todo/';

    async updateTitle(todoId, title) {
        return await axios.patch(`${this.url}${todoId}`, {title});
    }
}