<template>
   <div>
    <h4 style="text-align: center">Login to your account</h4>

    <div class="col-md-4 offset-md-4">
      <form @submit.prevent="login">
        <input required="true" class="form-control" type="email" name="email" v-model="email" placeholder="Email" />
        <input required="true" class="form-control" type="password" name="password" v-model="password" placeholder="Password" />
     <br>   
     <button class="btn btn-outline-success" type="submit">Login</button>
    </form>
    <span style="color:crimson">{{ error }}</span>
    </div>
   </div>

   
  </template>
  
  <script>
  import axios from 'axios';
  export default {
    data() {
      return {
        email: '',
        password: '',
        error: '',
      };
    },

    methods: {
      async login() {
        try {
          const response = await axios.post('/api/login', {
            email: this.email,
            password: this.password
          });
          
          // Assuming your API returns a token and username
          const token = response.data.token;
          const user = response.data.user;
          // Save the token and username to localStorage
          localStorage.setItem('auth_token', token);
          localStorage.setItem('user', JSON.stringify(user));  

          // Hide the logout button after logging out
          const loginButton = document.getElementById('login-btn');
          if (loginButton) {
            loginButton.style.display = 'none';
          }
          const registerButton = document.getElementById('register-btn');
          if (registerButton) {
            registerButton.style.display = 'none';
          }
          const logoutButton = document.getElementById('logout-btn');
          if (logoutButton) {
               logoutButton.style.display = 'bloc';
           }
          // Redirect to the home page after login
          // Reload the page
          window.location.reload();

          // Wait for 5 seconds before navigating to the home page
          setTimeout(() => {
              // Push the user to the home page after 5 seconds
              this.$router.push({ name: 'home' });
          }, 5000);


        } catch (error) {
          console.error(error.response.data);
          this.error = error.response.data.message;

        }
      }
    }
  };
  </script>
  
  