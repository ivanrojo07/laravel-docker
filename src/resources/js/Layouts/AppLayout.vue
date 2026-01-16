<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();
// Obtenemos el usuario de los datos compartidos
const user = computed(() => page.props.auth.user);
</script>

<template>
  <div class="min-h-screen flex flex-col">
    <header class="bg-gray-800 text-white p-4 shadow-md">
      <nav class="container mx-auto flex justify-between items-center">
        <Link href="/" class="text-xl font-bold">Rapid Auto</Link>
        
        <div class="space-x-4">
          <template v-if="!user">
            <Link href="/login" class="hover:underline">Login</Link>
            <Link href="/register" class="hover:underline">Registro</Link>
          </template>

          <template v-else>
            <span class="font-medium">Hola, {{ user.name }}</span>
            <Link href="/logout" method="post" as="button" class="text-red-400 hover:text-red-300">
              Cerrar Sesión
            </Link>
          </template>
        </div>
      </nav>
    </header>

    <main class="flex-grow container mx-auto p-6">
      <slot /> </main>

    <footer class="bg-gray-100 p-4 text-center text-gray-600 border-t">
      <p>&copy; 2026 Rapid Auto - Todos los derechos reservados.</p>
    </footer>
  </div>
</template>