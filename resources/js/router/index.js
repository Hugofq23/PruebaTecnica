import { createRouter, createWebHistory } from 'vue-router'
import Login from '../Pages/Auth/Login.vue'
import Register from '../Pages/Auth/Register.vue'
import Users from '../Pages/Users.vue'

const routes = [
  { path: '/', redirect: '/login' },
  { path: '/login', component: Login },
  { path: '/register', component: Register },
  { path: '/users', component: Users },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router