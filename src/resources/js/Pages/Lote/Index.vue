<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import ModalConfirm from '../../Components/ModalConfirm.vue';

const props = defineProps({
    lotes: Object, 
});

const showModal = ref(false);
const selectedId = ref(null);

console.log(props.lotes);

const openModal = (id) => {
    selectedId.value = id;
    showModal.value = true;
};

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
                title="¿Eliminar Lote?"
                message="Esta acción borrará permanentemente el lote. ¿Deseas continuar?"
                @close="showModal = false"
                @confirm="handleDelete"
            />
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold">Listado de Lotes</h1>
                <Link href="/lote/create" class="bg-indigo-600 text-white px-4 py-2 rounded shadow">
                    Nuevo Lote
                </Link>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dirección</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="lote in props.lotes?.data" :key="lote.id">
                            <td class="px-6 py-4 whitespace-nowrap">{{ lote.id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ lote.name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ lote.address }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-3">
                                    <Link :href="`/lote/${lote.id}/edit`" class="text-indigo-600 hover:text-indigo-900">Editar</Link>
                                    <button @click="openModal(lote.id)" class="text-red-600 hover:text-red-900">
                                        Eliminar
                                    </button>
                                </div>
                                
                            </td>
                        </tr>
                        <tr v-if="props.lotes?.data?.length === 0">
                            <td colspan="3" class="text-center py-10 text-gray-500">No hay datos disponibles</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div v-if="props.lotes?.links" class="mt-6">
                <nav class="flex justify-center space-x-1">
                    <template v-for="(link, k) in props.lotes.links" :key="k">
                        <span 
                            v-if="link.url === null" 
                            v-html="link.label" 
                            class="px-4 py-2 border rounded text-gray-400 bg-gray-50 cursor-default"
                        ></span>
                        
                        <Link 
                            v-else
                            :href="link.url" 
                            v-html="link.label"
                            :class="{ 'bg-indigo-600 text-white border-indigo-600': link.active, 'bg-white text-gray-700 hover:bg-gray-50': !link.active }"
                            class="px-4 py-2 border rounded transition-colors duration-200"
                        />
                        
                    </template>
                </nav>
            </div>
        </div>
    </AppLayout>
</template>