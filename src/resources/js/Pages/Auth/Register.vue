<script setup>
import { useForm } from '@inertiajs/vue3';
import AppLayout from '../../Layouts/AppLayout.vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post('/register', {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <AppLayout>
    <div class="register-container">
        <h1>Crear Cuenta</h1>
        
        <form @submit.prevent="submit">
            <div>
                <label>Nombre</label>
                <input v-model="form.name" type="text" required autofocus />
                <div v-if="form.errors.name" style="color: red;">{{ form.errors.name }}</div>
            </div>

            <div>
                <label>Email</label>
                <input v-model="form.email" type="email" required />
                <div v-if="form.errors.email" style="color: red;">{{ form.errors.email }}</div>
            </div>

            <div>
                <label>Contraseña</label>
                <input v-model="form.password" type="password" required />
                <div v-if="form.errors.password" style="color: red;">{{ form.errors.password }}</div>
            </div>

            <div>
                <label>Confirmar Contraseña</label>
                <input v-model="form.password_confirmation" type="password" required />
            </div>

            <button type="submit" :disabled="form.processing">
                {{ form.processing ? 'Registrando...' : 'Registrarse' }}
            </button>
        </form>
    </div>
    </AppLayout>
</template>