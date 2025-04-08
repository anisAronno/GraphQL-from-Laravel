<template>
  <div v-if="loading" class="text-center my-5 p-5 bg-gray-50 rounded-lg">
    Loading post...
  </div>
  
  <div v-else-if="error" class="text-center my-5 p-5 bg-gray-50 rounded-lg text-red-500">
    Error: {{ error.message }}
  </div>
  
  <div v-else-if="post" class="max-w-7xl mx-auto">
    <h1 class="text-3xl font-bold mb-4">{{ post.title }}</h1>
    
    <div class="flex justify-between text-sm text-gray-500 mb-6">
      <span>Posted by: {{ post.author_name }}</span>
      <span>Date: {{ formatDate(post.created_at) }}</span>
    </div>
    
    <div class="prose prose-lg">
      {{ post.body }}
    </div>
    
    <div class="mt-8">
      <router-link to="/" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition-colors">
        Back to Posts
      </router-link>
    </div>
  </div>
  
  <div v-else class="text-center my-5 p-5 bg-gray-50 rounded-lg">
    Post not found.
  </div>
</template>

<script setup>
import { computed } from 'vue';
import { useRoute } from 'vue-router';
import { useQuery } from '@vue/apollo-composable';
import gql from 'graphql-tag';

const route = useRoute();
const postId = parseInt(route.params.id);

// GraphQL query for single post
const GET_POST = gql`
  query GetPost($id: ID!) {
    post(id: $id) {
      id
      title
      body
      created_at
      author_name
    }
  }
`;

// Execute the query
const { result, loading, error } = useQuery(GET_POST, {
  id: postId
});

// Computed property for post
const post = computed(() => {
  return result.value?.post;
});

// Format date helper
const formatDate = (dateString) => {
  const date = new Date(dateString);
  return date.toLocaleDateString();
};
</script>