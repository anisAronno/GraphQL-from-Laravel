<!-- src/components/PostSearch.vue -->
<template>
    <div class="mb-5 flex gap-2">
        <input 
            type="text" 
            v-model="titleQuery" 
            placeholder="Search posts by title..." 
            @keyup.enter="search"
            class="flex-grow p-2 border border-gray-300 rounded"
        />
        <button 
            @click="search"
            class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600"
        >
            Search
        </button>
        <button 
            v-if="titleQuery"
            @click="clearSearch"
            class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600"
        >
            Clear
        </button>
    </div>
</template>

<script>
import { ref } from 'vue'

export default {
    name: 'PostSearch',
    emits: ['search'],
    setup(props, { emit }) {
        const titleQuery = ref('')
        
        const search = () => {
            emit('search', titleQuery.value ? `${titleQuery.value}%` : '')
        }
        
        const clearSearch = () => {
            titleQuery.value = ''
            emit('search', '')
        }
        
        return {
            titleQuery,
            search,
            clearSearch
        }
    }
}
</script>
