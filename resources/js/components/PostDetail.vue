<template>
    <div class="w-full p-5">
        <div v-if="loading" class="text-center my-10">
            Loading post...
        </div>
        
        <div v-else-if="error" class="text-center my-10">
            Error: {{ error.message }}
        </div>
        
        <div v-else-if="post" class="post-content">
            <h1 class="text-3xl font-bold mb-3">{{ post.title }}</h1>
            <div class="space-x-3 mb-5 text-sm text-gray-600">
                <span>Posted by: {{ post.author_name }}</span>
                <span>Date: {{ formatDate(post.created_at) }}</span>
            </div>
            <div class="leading-relaxed mb-8 whitespace-pre-line">
                {{ post.body }}
            </div>
            <button 
                @click="goBack" 
                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition-colors cursor-pointer"
            >
                Go Back
            </button>
        </div>
        
        <div v-else class="text-center my-10">
            Post not found.
        </div>
    </div>
</template>

<script>
import { useQuery } from '@vue/apollo-composable'
import { computed } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import gql from 'graphql-tag'

export default {
  name: 'PostDetail',
  setup() {
    const router = useRouter()
    const route = useRoute()
    const postId = computed(() => route.params.id)
    
    const GET_POST = gql`
      query GetPost($id: ID!) {
        post(id: $id) {
          id
          title
          body
          created_at
          updated_at
          author_name
        }
      }
    `
    
    const { result, loading, error } = useQuery(
      GET_POST,
      { id: postId },
      { enabled: computed(() => !!postId.value) }
    )
    
    const post = computed(() => result.value?.post)
    
    const formatDate = (dateString) => {
      const date = new Date(dateString)
      return date.toLocaleDateString()
    }
    
    const goBack = () => {
      router.back()
    }
    
    return {
      post,
      loading,
      error,
      formatDate,
      goBack
    }
  }
}
</script>