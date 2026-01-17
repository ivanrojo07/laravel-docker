import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue';
import path from 'path';

export default defineConfig({
    server: {
        host: '0.0.0.0', // Escucha en todas las IPs del contenedor
        port: 5173,
        strictPort: true,
        hmr: {
            host: 'localhost', // El navegador buscará el socket en tu máquina real
        },
        watch: {
            usePolling: true, // Fuerza a Vite a revisar cambios manualmente
            interval: 10,    // Cada 100ms
        },
    },
    resolve: {
        alias: {
            '@': path.resolve(__dirname, './resources/js'),
        },
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
        vue(),
    ],
});
