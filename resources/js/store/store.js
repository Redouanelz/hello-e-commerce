import { createStore } from 'vuex';
import axios from 'axios';

export default createStore({
    state: {
      user: JSON.parse(localStorage.getItem('user')) || null,
      token: localStorage.getItem('auth_token') || '',
      error: '',
    },
    getters: {
      getUser: (state) => state.user,
    },
  });
  
