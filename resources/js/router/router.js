import {createRouter, createWebHistory} from 'vue-router';
import LoginComponent from '../components/Login/LoginComponent';
import RouteNames from './RouteNames';
import RegistrationComponent from '../components/Registration/RegistrationComponent';
import TodoLists from '../components/TodoLists/TodoLists';
import WelcomePage from '../components/WelcomePage/WelcomePage';
import NotFound from '../components/NotFound/NotFound';


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
      name: RouteNames.lists,
      path: '/lists',
      component: TodoLists,
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
    return next({name: RouteNames.lists});
  }

  return next();
});

export default router;