import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import './bootstrap'

createApp(App).use(router).mount('#app')
const token = localStorage.getItem('token')
if (token) {
  axios.defaults.headers.common['Authorization'] = `Bearer ${token}`
}