<template>
  <div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white p-8 rounded shadow w-full max-w-md">
      <h1 class="text-xl font-bold mb-4 text-center">Iniciar sesión</h1>

      <form @submit.prevent="login">
        <div class="mb-4">
          <label for="email" class="block text-sm">Correo</label>
          <input v-model="email" type="email" id="email" class="w-full border px-3 py-2 rounded" required />
        </div>

        <div class="mb-4">
          <label for="password" class="block text-sm">Contraseña</label>
          <input v-model="password" type="password" id="password" class="w-full border px-3 py-2 rounded" required />
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
          Iniciar sesión
        </button>
        <p class="text-sm text-center mt-4">
            ¿No tienes cuenta?
            <router-link to="/register" class="text-blue-600 hover:underline">Regístrate</router-link>
        </p>

        <p v-if="error" class="text-red-500 text-sm mt-3 text-center">{{ error }}</p>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'

const email = ref('')
const password = ref('')
const error = ref('')
const router = useRouter()

const login = async () => {
  error.value = ''
  try {
    const response = await axios.post('/api/login', {
        email: email.value,
        password: password.value
    })

    const token = response.data.token
    localStorage.setItem('token', token)
    axios.defaults.headers.common['Authorization'] = `Bearer ${token}`

    router.push('/users')
  } catch (err) {
    error.value = 'Credenciales incorrectas'
  }
  
}

</script>