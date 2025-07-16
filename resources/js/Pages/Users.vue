<template>
  <div class="p-6 max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Usuarios registrados</h1>

    <table class="w-full border mb-6">
      <thead class="bg-gray-100">
        <tr>
          <th class="text-left p-2 border">ID</th>
          <th class="text-left p-2 border">Nombre</th>
          <th class="text-left p-2 border">Email</th>
          <th class="text-left p-2 border">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in users" :key="user.id" class="border-t">
          <td class="p-2 border">{{ user.id }}</td>
          <td class="p-2 border">{{ user.name }}</td>
          <td class="p-2 border">{{ user.email }}</td>
          <td class="p-2 border space-x-2">
            <button @click="editUser(user)" class="text-blue-600 hover:underline">Editar</button>
            <button @click="deleteUser(user.id)" class="text-red-600 hover:underline">Eliminar</button>
          </td>
        </tr>
      </tbody>
    </table>

    <button
      @click="loadDomains"
      class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700"
    >
      Ver dominios de email
    </button>
    <div v-if="showModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50">
        <div class="bg-white p-6 rounded shadow w-full max-w-md relative">
            <h2 class="text-lg font-bold mb-4">Editar usuario</h2>

            <form @submit.prevent="saveUser">
            <div class="mb-4">
                <label class="block text-sm">Nombre</label>
                <input v-model="editingUser.name" type="text" class="w-full border px-3 py-2 rounded" required />
            </div>

            <div class="mb-4">
                <label class="block text-sm">Correo</label>
                <input v-model="editingUser.email" type="email" class="w-full border px-3 py-2 rounded" required />
            </div>

            <div class="flex justify-between mt-6">
                <button type="button" @click="closeModal" class="text-gray-600 hover:underline">Cancelar</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Guardar cambios
                </button>
            </div>
            </form>
        </div>
    </div>

    <div v-if="Object.keys(domains).length > 0" class="mt-4">
      <h2 class="text-lg font-semibold mb-2">Dominios registrados</h2>
      <ul class="list-disc list-inside">
        <li v-for="(count, domain) in domains" :key="domain">
          {{ domain }}: {{ count }}
        </li>
      </ul>
    </div>
  </div>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

const users = ref([])
const domains = ref({})
const router = useRouter()
const editingUser = ref(null)
const showModal = ref(false)

// Reutiliza el token de localStorage
axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`

const fetchUsers = async () => {
  try {
    const response = await axios.get('/api/users')
    users.value = response.data
  } catch (error) {
    if (error.response.status === 401) {
      router.push('/login')
    }
  }
}

const deleteUser = async (id) => {
  if (!confirm('¿Estás seguro de eliminar este usuario?')) return
  try {
    await axios.delete(`/api/users/${id}`)
    fetchUsers()
  } catch (err) {
    alert('Error al eliminar el usuario')
  }
}

const editUser = (user) => {
  editingUser.value = { ...user } // copia para no editar directo
  showModal.value = true
}

const loadDomains = async () => {
  try {
    const response = await axios.get('/api/email-domains')
    domains.value = response.data
  } catch (err) {
    alert('Error al obtener dominios')
  }
}
const saveUser = async () => {
  try {
    await axios.put(`/api/users/${editingUser.value.id}`, {
      name: editingUser.value.name,
      email: editingUser.value.email
    })
    closeModal()
    fetchUsers()
  } catch (err) {
    alert('Error al actualizar el usuario')
  }
}

const closeModal = () => {
  showModal.value = false
  editingUser.value = null
}

onMounted(() => {
  fetchUsers()
})
</script>