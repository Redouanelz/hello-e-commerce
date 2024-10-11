<template>
  <div>
    <h4 style="text-align: center">Create an account</h4>

    <div class="col-md-4 offset-md-4">
      <form @submit.prevent="register">
        <input class="form-control" type="text" name="name" v-model="name" placeholder="Name" />
        <input class="form-control" type="email"  name="email" v-model="email" placeholder="Email" />
        <input class="form-control" type="password" name="password" v-model="password" placeholder="Password" />
         <br>
        <button class="btn btn-outline-success" type="submit">Register</button>
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
        name: '',
        email: '',
        password: '',
        error: '',
      };
    },
    methods: {
      async register() {
        try {
          const response = await axios.post('/api/register', {
            name: this.name,
            email: this.email,
            password: this.password
          });
          alert(response.data.message);

            // Push the user to the home page after 5 seconds
              this.$router.push({ name: 'login' });
        } catch (error) {
          console.error(error.response.data);
          this.error = error.response.data.message;

        }
      }
    }
  };
  </script>
  