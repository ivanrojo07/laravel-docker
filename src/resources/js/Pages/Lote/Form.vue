<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
const props = defineProps({
    lote: Object || null, 
});
console.log(props.lote);

const form = useForm({
    name:  props.lote ? props.lote.name : '',
    address: props.lote ? props.lote.address : '',
});

const submit = () => {
    if (props.lote?.id) {
        form.put(`/lote/${props.lote.id}`,{
            onFinish: () => form.reset('name', 'address'),
        });
    }
    else{
        form.post('/lote', {
            onFinish: () => form.reset('name', 'address'),
        });
    }
};
</script>

<template>
    <AppLayout>
        <Head title="Crear Lote" />
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <form @submit.prevent="submit" class="max-w-md mx-auto">
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nombre del Lote</label>
                            <input
                                id="name"
                                type="text"
                                v-model="form.name"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                :class="{ 'border-red-500': form.errors.name }"
                            />
                            <div v-if="form.errors.name" class="text-red-500 text-xs mt-1">
                                {{ form.errors.name }}
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="address" class="block text-sm font-medium text-gray-700">Dirección</label>
                             <input
                                id="address"
                                type="text"
                                v-model="form.address"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                :class="{ 'border-red-500': form.errors.address }"
                            />
                            <div v-if="form.errors.address" class="text-red-500 text-xs mt-1">
                                {{ form.errors.address }}
                            </div>
                        </div>

                        <div class="flex items-center justify-end space-x-4">
                            <Link href="/lote" class="text-sm text-gray-600 hover:text-gray-900 underline">
                                Cancelar
                            </Link>
                            <button
                                type="submit"
                                :disabled="form.processing"
                                class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50"
                            >
                                <span v-if="form.processing">Guardando...</span>
                                <span v-else>Guardar Lote</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>