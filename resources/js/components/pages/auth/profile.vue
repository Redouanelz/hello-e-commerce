<template>
        <h4 style="text-align: center">My Account Profile</h4>
        <router-link class="nav-link" to="/">Back to Home</router-link>

    <div class="row">
      <div class="col-md-6 offset-3">
        <div class="alert alert-success" role="alert" >
        <p>You can modify your profile information here at any time. Simply update the fields with your new details, and click 'Save' to apply the changes, managing your account is quick and easy.</p>
        </div>
        <form @submit.prevent="updateUser"> <!-- Added @submit.prevent -->
        <label for="name">Full name*</label>
        <input required type="text" class="form-control" 
        name="name" placeholder="Enter your full name"
        v-model="user.name">

        <label for="email">Email Adress*</label>
        <input required type="text" class="form-control" 
        name="email" placeholder="Enter your email adress"
        v-model="user.email">

        <label for="adress">Full Adress</label>
        <input type="text" class="form-control" 
        name="address" placeholder="Enter your adress"
        v-model="user.address">

        <label for="phone">Phone number</label>
        <input type="text" class="form-control" 
        name="phone" placeholder="Enter your phone number"
        v-model="user.phone">

        <label for="date_naissance">Birthday</label>
        <input type="date" class="form-control" 
        name="date_naissance" placeholder="Enter your birthday"
        v-model="user.date_naissance">
        <br>
        <input type="submit" value="Save informations" class="btn btn-outline-danger">
      </form>
      </div>
    </div>
</template>

<script>
import axios from 'axios';
import { mapGetters } from 'vuex';

export default {
    data() {
      return {
        user: {
          name: '',
          email: '',
          address: '',
          phone: '',
          date_naissance: '',
        },
        id:null,
      };
    },
    mounted(){
      this.getUser();
    },
    
    methods: {
      async getUser() {
      try {
        this.user = JSON.parse(localStorage.getItem('user'));
        this.id = this.user ? this.user.id : 0;  
        const response = await axios.get(`/api/profile/${this.id}`);
        this.user = response.data;
          } catch (error) {
            console.error('Error:', error);
          }
      },

      async updateUser() {
      try {
        const response = await axios.put(`/api/profile/${this.id}`, this.user);
            // Optionally update the user data in localStorage
            localStorage.setItem('user', JSON.stringify(this.user));
            alert('Profile updated successfully!');
          } catch (error) {
            console.error('Error updating user:', error);
          }
      },


    },
}
</script>