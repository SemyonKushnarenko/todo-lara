import {createRouter, createWebHistory} from 'vue-router';
import LoginComponent from '../Pages/Login/LoginComponent';
import RouteNames from './RouteNames';
import RegistrationComponent from '../Pages/Registration/RegistrationComponent';
import MainPage from '../Pages/MainPage/MainPage';
import WelcomePage from '../Pages/WelcomePage/WelcomePage';
import NotFound from '../components/NotFound/NotFound';
import TodoListPage from "../Pages/TodoListPage/TodoListPage";


const router = createRouter({
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
      name: RouteNames.welcomePage,
      path: '/welcome',
      component: WelcomePage,
    },
    {
      name: RouteNames.main,
      path: '/main',
      component: MainPage,
    },
    {
      name: RouteNames.todoListPage,
      path: '/todo-list/:todoListId(\\d+)',
      component: TodoListPage,
      props: true,
    },
    {
      name: RouteNames.notFound,
      path: '/:pathMatch(.*)*',
      component: NotFound,
    },
  ],
});

router.beforeEach((to, from, next) => {
  const token = localStorage.getItem('x-xsrf-token');
  const availableRoutes = [
    RouteNames.login,
    RouteNames.registration,
    RouteNames.welcomePage,
  ];
  const isRouteAvailable = availableRoutes.includes(to.name);

  if (!token) {
    if (isRouteAvailable) {
      console.log('first');
      return next();
    } else {
      console.log('second');
      return next({name: RouteNames.login});
    }
  }

  if (token && isRouteAvailable) {
    return next({name: RouteNames.main});
  }

  return next();
});

export default router;