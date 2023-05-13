import { createRouter, createWebHistory } from 'vue-router'
import HomePage from '../views/HomePage.vue'
import AdminPannel from '../views/admin/AdminPannel.vue'
import DashBoard from '../views/admin/DashBoard.vue'

// Category Routes
import CategoryIndex from '../views/admin/category/index.vue'

// Author Routes
import AuthorIndex from '../views/admin/author/index.vue'

// Book Routes
import BookIndex from '../views/admin/book/index.vue'

// Client Route
import ClientView from '../views/client/ClientView.vue'

//User Route
import UserIndex from '../views/admin/user/index.vue'

//Admin Routes
import Register from '../views/auth/register.vue'
import Login from '../views/auth/login.vue'

import { authStore } from '../../pinaStore/authStore'


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomePage
    },
    {
      path: '/register',
      name: 'register',
      component: Register
    },
    {
      path: '/login',
      name: 'login',
      component: Login
    },
    {
      path: '/client',
      name: 'client',
      component:ClientView
    },
    {
      path: '/admin',
      name: 'admin',
      component: AdminPannel,
      meta: {
        middleware: 'auth',
      },
      children:[
        {
          path: '',
          name: 'dash-board',
          component: DashBoard
        },
        {
          path: 'categories/',
          name: 'category',
          component: CategoryIndex
        },
  
        {
          path: 'authors/',
          name: 'author',
          component: AuthorIndex
        },
        {
          path: 'books/',
          name: 'book',
          component: BookIndex
        },   
        {
          path: 'user/',
          name: 'user',
          component: UserIndex
        },      
      ]
    },
  ]
})
router.beforeEach((to, from, next) => {
  const auth = authStore();
  if (to.meta.middleware === "auth") {
    auth.verifyAuth();
    if (auth.authenicated) {
          next();
    } else {
      next('/login');
    }
  } else {
    next(); 
  }
});

export default router
