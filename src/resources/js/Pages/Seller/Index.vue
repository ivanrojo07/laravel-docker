<script setup>
import { ref } from 'vue';
import AppLayout from '../../Layouts/AppLayout.vue';
import ModalConfirm from '../../Components/ModalConfirm.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    sellers: Object,
});

const showModal = ref(false);
const selectedId = ref(null);

console.log(props.sellers);

const openModal = (id) => {
    selectedId.value = id;
    showModal.value = true;
}

const handleDelete = () => {
    router.delete(`/lote/${selectedId.value}`, {
        onSuccess: () => {
            showModal.value = false;
        }
    });
};
</script>

<template>
    <AppLayout>
        <div class="p-6">
            <ModalConfirm 
                :show="showModal" 
                title="¿Eliminar Vendedor?"
                message="Esta acción borrará permanentemente el vendedor. ¿Deseas continuar?"
                @close="showModal = false"
                @confirm="handleDelete"
            />
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold">Listado de Vendedores</h1>
                <Link href="/seller/create" class="bg-indigo-600 text-white px-4 py-2 rounded shadow">
                    Importar Vendedores
                </Link>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Correo Electronico</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telefono</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lote</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="seller in props.sellers?.data" :key="seller.id">
                            <td class="px-6 py-4 whitespace-nowrap">{{ seller.id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ seller.name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ seller.username }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ seller.email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ seller.phone }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ seller.lote.name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-3">
                                    <Link :href="`/seller/${seller.id}/edit`" class="text-indigo-600 hover:text-indigo-900">Editar</Link>
                                    <button @click="openModal(seller.id)" class="text-red-600 hover:text-red-900">
                                        Eliminar
                                    </button>
                                </div>
                                
                            </td>
                        </tr>
                        <tr v-if="props.sellers?.data?.length === 0">
                            <td colspan="3" class="text-center py-10 text-gray-500">No hay datos disponibles</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AppLayout>
</template>