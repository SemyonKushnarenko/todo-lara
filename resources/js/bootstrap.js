import axios from 'axios';
import RouteNames from "./router/RouteNames";
import router from "./router/router";
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.withCredentials = true;
window.axios.interceptors.response.use({}, error => {
    if (error.response.status === 401 || error.response.status === 419) {
        const token = localStorage.getItem('x-xsrf-token');
        if (token) localStorage.removeItem('x-xsrf-token');
        router.push({name: RouteNames.login});
    }
});
