<template>
    <div>
        <h1 class="text-2xl font-bold mb-6">Blog Posts</h1>

        <!-- Search component with initial value -->
        <PostSearch @search="onSearch" :initialSearch="searchTitle" />

        <!-- Loading state -->
        <div v-if="loading" class="text-center my-5 p-5 bg-gray-50 rounded-lg">
            Loading posts...
        </div>

        <!-- Error state -->
        <div
            v-else-if="error"
            class="text-center my-5 p-5 bg-gray-50 rounded-lg text-red-500"
        >
            Error: {{ error.message }}
        </div>

        <!-- Post list -->
        <div v-else class="space-y-6">
            <div
                v-if="posts.length === 0"
                class="text-center my-5 p-5 bg-gray-50 rounded-lg"
            >
                No posts found.
            </div>

            <div
                v-else
                class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-5"
            >
                <div
                    v-for="post in posts"
                    :key="post.id"
                    class="border border-gray-200 rounded-lg p-4 shadow-sm hover:-translate-y-1 transition-transform duration-300 ease-in-out"
                >
                    <router-link
                        :to="`/post/${post.id}`"
                        class="no-underline text-gray-800"
                    >
                        <h2 class="mt-0 text-blue-500 text-xl font-semibold">
                            {{ post.title }}
                        </h2>
                    </router-link>
                    <p class="text-gray-600 mb-4">
                        {{ truncate(post.body, 150) }}
                    </p>
                    <div class="flex justify-between text-sm text-gray-500">
                        <span>Posted by: {{ post.author_name }}</span>
                        <span>Date: {{ formatDate(post.created_at) }}</span>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="flex justify-center items-center mt-8 gap-4">
                <button
                    :disabled="currentPage <= 1"
                    @click="previousPage"
                    class="px-4 py-2 bg-green-500 text-white rounded disabled:bg-gray-300 disabled:cursor-not-allowed hover:bg-green-600 transition-colors cursor-pointer"
                >
                    Previous
                </button>
                <span>Page {{ currentPage }} of {{ totalPages }}</span>
                <button
                    :disabled="currentPage >= totalPages"
                    @click="nextPage"
                    class="px-4 py-2 bg-green-500 text-white rounded disabled:bg-gray-300 disabled:cursor-not-allowed hover:bg-green-600 transition-colors cursor-pointer"
                >
                    Next
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, watch } from "vue";
import { useRoute, useRouter } from "vue-router";
import { useQuery } from "@vue/apollo-composable";
import gql from "graphql-tag";
import PostSearch from "./PostSearch.vue";

const route = useRoute();
const router = useRouter();
const pageSize = ref(12);

// Get values from route
const currentPage = ref(parseInt(route.query.page) || 1);
const searchTitle = ref(route.query.search || "");

// Watch for route changes
watch(
    () => route.query,
    (newQuery) => {
        currentPage.value = parseInt(newQuery.page) || 1;
        searchTitle.value = newQuery.search || "";
        refetch();
    },
    { deep: true }
);

// GraphQL query
const GET_POSTS = gql`
    query GetPosts($first: Int!, $page: Int!, $title: String) {
        posts(first: $first, page: $page, title: $title) {
            data {
                id
                title
                body
                created_at
                author_name
            }
            paginatorInfo {
                currentPage
                lastPage
                total
                hasMorePages
            }
        }
    }
`;

// Execute query
const { result, loading, error, refetch } = useQuery(GET_POSTS, () => ({
    first: pageSize.value,
    page: currentPage.value,
    title: searchTitle.value || undefined,
}));

// Computed properties
const posts = computed(() => result.value?.posts?.data || []);
const paginatorInfo = computed(
    () =>
        result.value?.posts?.paginatorInfo || {
            currentPage: 1,
            lastPage: 1,
            total: 0,
            hasMorePages: false,
        }
);
const totalPages = computed(() => paginatorInfo.value.lastPage);

// Navigation methods
const nextPage = async () => {
    if (currentPage.value < totalPages.value) {
        await updateRoute(currentPage.value + 1, searchTitle.value);
    }
};

const previousPage = async () => {
    if (currentPage.value > 1) {
        await updateRoute(currentPage.value - 1, searchTitle.value);
    }
};

// Update route helper
const updateRoute = async (page, search) => {
    await router.push({
        path: "/",
        query: {
            ...(page > 1 && { page }),
            ...(search && { search }),
        },
    });
};

// Search functionality
const onSearch = async (query) => {
    await updateRoute(1, query); // Reset to page 1 when searching
};

// Helper functions
const formatDate = (dateString) => {
    const date = new Date(dateString);
    return date.toLocaleDateString();
};

const truncate = (text, length) => {
    if (!text) return "";
    return text.length > length ? `${text.substring(0, length)}...` : text;
};
</script>
