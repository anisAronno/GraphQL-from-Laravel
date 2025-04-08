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

<script setup>
import { ref, onMounted, watch } from 'vue';

const props = defineProps({
    initialSearch: {
        type: String,
        default: ''
    }
});

const emit = defineEmits(['search']);
const titleQuery = ref('');

// Clean the search term (remove % if present)
const cleanSearchTerm = (term) => {
    return term ? term.replace(/%$/, '') : '';
};

// Set initial value from props
onMounted(() => {
    titleQuery.value = cleanSearchTerm(props.initialSearch);
});

// Watch for changes in initialSearch prop
watch(() => props.initialSearch, (newValue) => {
    titleQuery.value = cleanSearchTerm(newValue);
});

const search = () => {
    // Add % only when emitting the search event
    emit('search', titleQuery.value ? `${titleQuery.value}%` : '');
};

const clearSearch = () => {
    titleQuery.value = '';
    emit('search', '');
};
</script>