import './bootstrap';

import  { createApp } from 'vue'

import app from './components/app.vue'
import store from './store/store';  // Import Vuex store
import router from './router'

createApp(app).use(store).use(router).mount('#app')