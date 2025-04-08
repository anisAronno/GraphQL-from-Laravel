import './bootstrap';
import { createApp } from 'vue'
import App from './App.vue'
import { provideApolloClient } from '@vue/apollo-composable'
import { apolloClient } from './apollo'
import router from './router'

const app = createApp(App)
provideApolloClient(apolloClient)
app.use(router)
app.mount('#app')