<script setup>
import { useForm } from '@inertiajs/vue3'
import AppLayout from '../../Layouts/AppLayout.vue';

const form = useForm({
  email: '',
  password: '',
})

const submit = () => {
  form.post('/login')
}
</script>

<template>
  <AppLayout>
  <form @submit.prevent="submit">
    <input v-model="form.email" type="email" placeholder="Email" />
    <input v-model="form.password" type="password" placeholder="Contraseña" />
    <button :disabled="form.processing">Entrar</button>
  </form>
  </AppLayout>
</template>