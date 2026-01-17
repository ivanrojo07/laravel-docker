<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    links: Array,
});
</script>

<template>
    <div v-if="links.length > 3" class="mt-6">
        <nav class="flex justify-center space-x-1">
            <template v-for="(link, k) in links" :key="k">
                <span 
                    v-if="link.url === null" 
                    v-html="link.label" 
                    class="px-4 py-2 border rounded text-gray-400 bg-gray-50 cursor-default text-sm"
                ></span>
                
                <Link 
                    v-else
                    :href="link.url" 
                    v-html="link.label"
                    :class="{ 
                        'bg-indigo-600 text-white border-indigo-600 z-10': link.active, 
                        'bg-white text-gray-700 hover:bg-gray-50 border-gray-300': !link.active 
                    }"
                    class="px-4 py-2 border rounded transition-colors duration-200 text-sm"
                />
            </template>
        </nav>
    </div>
</template>