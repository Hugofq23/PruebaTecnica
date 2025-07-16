<template>
  <div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white p-8 rounded shadow w-full max-w-md">
      <h1 class="text-xl font-bold mb-4 text-center">Registro</h1>

      <form @submit.prevent="register">
        <div class="mb-4">
          <label for="name" class="block text-sm">Nombre</label>
          <input v-model="name" type="text" id="name" class="w-full border px-3 py-2 rounded" required />
        </div>

        <div class="mb-4">
          <label for="email" class="block text-sm">Correo</label>
          <input v-model="email" type="email" id="email" class="w-full border px-3 py-2 rounded" required />
        </div>

        <div class="mb-4">
          <label for="password" class="block text-sm">Contraseña</label>
          <input v-model="password" type="password" id="password" class="w-full border px-3 py-2 rounded" required />
        </div>

        <button type="submit" class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">
          Registrarse
        </button>

        <p v-if="error" class="text-red-500 text-sm mt-3 text-center">{{ error }}</p>
        <p class="text-sm text-center mt-4">
          ¿Ya tienes cuenta?
          <router-link to="/login" class="text-blue-600 hover:underline">Inicia sesión</router-link>
        </p>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'

const name = ref('')
const email = ref('')
const password = ref('')
const error = ref('')
const router = useRouter()

const register = async () => {
  error.value = ''
  try {
    const response = await axios.post('/api/register', {
      name: name.value,
      email: email.value,
      password: password.value
    })

    // Login automático tras registrarse
    const token = await axios.post('/api/login', {
      email: email.value,
      password: password.value
    })

    localStorage.setItem('token', token.data.token)
    axios.defaults.headers.common['Authorization'] = `Bearer ${token.data.token}`

    router.push('/users')
  } catch (err) {
    error.value = 'Error al registrarse. Puede que el correo ya exista.'
  }
}
</script>