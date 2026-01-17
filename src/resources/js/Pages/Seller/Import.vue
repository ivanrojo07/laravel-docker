<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

const url = ref('');
const loadingPreview = ref(false);

const props = defineProps({
    lotes: Object,
});

console.log(props.lotes);

const form = useForm({
    sellers: [] 
});

const fetchUrlData = async () => {
    if (!url.value) return;
    
    loadingPreview.value = true;
    try {
        const response = await fetch(url.value);
        const data = await response.json();
        
        form.sellers = data.map(item => ({
            name: item.name || '',
            username: item.username || '',
            email: item.email || '',
            phone: item.phone || '',
            lote_id: '',
        }));
    } catch (error) {
        alert("Error al obtener los datos. Verifica la URL o CORS.");
    } finally {
        loadingPreview.value = false;
    }
};

const removeRow = (index) => {
    form.sellers.splice(index, 1);
};

const submitImport = () => {
    form.post('/seller', {
        onSuccess: () => {
            url.value = '';
            form.reset();
        }
    });
};
</script>

<template>
    <AppLayout>
        <div class="max-w-7xl mx-auto py-10 px-4">
            <div class="bg-white shadow rounded-lg p-6 border border-gray-200">
                <h2 class="text-xl font-bold mb-4 text-gray-800">Sincronización Masiva</h2>
                
                <div class="flex space-x-2 mb-8">
                    <input v-model="url" type="url" placeholder="URL del JSON (ej. JSONPlaceholder)" 
                        class="flex-1 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                    <button @click="fetchUrlData" :disabled="loadingPreview" 
                        class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700 disabled:opacity-50 font-medium">
                        {{ loadingPreview ? 'Cargando...' : 'Obtener Datos' }}
                    </button>
                </div>

                <div v-if="form.sellers.length > 0">
                    <div class="flex items-center justify-between mb-4 p-4 bg-gray-50 rounded-lg">
                        <p class="text-sm text-gray-600">
                            Se cargaron <span class="font-bold text-indigo-600">{{ form.sellers.length }}</span> registros. Puedes editarlos antes de guardar.
                        </p>
                        <button @click="submitImport" :disabled="form.processing"
                            class="bg-green-600 text-white px-8 py-2 rounded-md font-bold hover:bg-green-700 shadow-lg">
                            {{ form.processing ? 'Guardando...' : 'Confirmar Carga Masiva' }}
                        </button>
                    </div>

                    <div class="space-y-3">
                        <div v-for="(seller, index) in form.sellers" :key="index" 
                            class="grid grid-cols-1 md:grid-cols-6 gap-3 p-3 border border-gray-100 rounded-md hover:bg-gray-50 transition">
                            
                            <div>
                                <label class="text-[10px] uppercase font-bold text-gray-400">Nombre</label>
                                <input v-model="form.sellers[index].name" type="text" 
                                    class="w-full text-sm border-gray-300 rounded focus:ring-indigo-500" />
                            </div>

                            <div>
                                <label class="text-[10px] uppercase font-bold text-gray-400">Username</label>
                                <input v-model="form.sellers[index].username" type="text" 
                                    class="w-full text-sm border-gray-300 rounded focus:ring-indigo-500" />
                            </div>

                            <div>
                                <label class="text-[10px] uppercase font-bold text-gray-400">Email</label>
                                <input v-model="form.sellers[index].email" type="email" 
                                    class="w-full text-sm border-gray-300 rounded focus:ring-indigo-500" />
                            </div>

                            <div>
                                <label class="text-[10px] uppercase font-bold text-gray-400">Teléfono</label>
                                <input v-model="form.sellers[index].phone" type="text" 
                                    class="w-full text-sm border-gray-300 rounded focus:ring-indigo-500" />
                            </div>

                            <div>
                                <label class="text-[10px] uppercase font-bold text-gray-400">Lote</label>
                                <select 
                                    id="lote_id"
                                    v-model="form.sellers[index].lote_id"
                                    class="w-full text-sm border-gray-300 rounded focus:ring-indigo-500" >
                                    <option value="" disabled selected>Selecciona un lote de la base de datos</option>
                                    <option 
                                        v-for="lote in props.lotes" 
                                        :key="lote.id"
                                        :value="lote.id"
                                        >
                                        {{ lote.name }}
                                    </option>
                                </select>
                            </div>

                            <div class="flex items-end justify-center pb-1">
                                <button @click="removeRow(index)" class="text-red-500 hover:text-red-700 p-2">
                                    Eliminar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>