import {createRouter, createWebHistory} from 'vue-router';
import LoginComponent from '../components/Login/LoginComponent'
import RouteNames from "./RouteNames";
import RegistrationComponent from "../components/Registration/RegistrationComponent";
import MainPage from "../components/MainPage/MainPage";


export default createRouter({
    history: createWebHistory(),
    routes: [
        {
            name: RouteNames.login,
            path: '/user/login',
            component: LoginComponent,
        },
        {
            name: RouteNames.registration,
            path: '/user/registration',
            component: RegistrationComponent,
        },
        {
            name: RouteNames.mainPage,
            path: '/main',
            component: MainPage,
        },
    ],
});