<template>
    <div class="" >
        <nav  class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="/">
                <img style="margin-left: 50px;" src="/public/logo.webp" width="60px" height="60px" alt="Example Image">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <router-link class="nav-link" to="/">Home</router-link>
                </li>
                <li class="nav-item" id="login-btn">
                    <router-link class="nav-link" to="/login">Login</router-link>
                </li>
                <li class="nav-item" id="register-btn">
                    <router-link class="nav-link" to="/register">Register</router-link>
                </li>

                <li class="nav-item" id="cart-btn ">
                    <router-link class="nav-link" to="/cart">Cart
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16"><path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/></svg>
                    </router-link>
                </li>
                <li class="nav-item" id="profile-btn" style="display:bloc">
                    <router-link class="nav-link" to="/profile">Profile
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16"><path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/><path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/></svg>
                    </router-link>
                </li>
                <li class="nav-item" id="pay-btn" style="display:bloc">
                    <router-link class="nav-link" to="/pay">Payments
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-credit-card" viewBox="0 0 16 16"><path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z"/><path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/></svg>                    </router-link>
                </li>

                
                <li class="nav-item float-right">
                    <span class="nav-link" >
                        <b>{{ username }}</b>
                        <button id="logout-btn" style="margin-left: 10px" 
                        class="btn btn-sm btn-outline-danger" 
                        @click="logout">Logout</button></span>
                    </li>
               </ul>
            </div>
        </nav>
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';

export default{
    name:'header-up',
    data() {
    return {
       username: '',
       user: [],
    };
  },
    mounted(){
        this.user = JSON.parse(localStorage.getItem('user'));
        this.username = this.user ? this.user.name : '';  
        if(this.user){
             // Hide the logout button after logging out
             const logoutButton = document.getElementById('logout-btn');
                if (logoutButton) {
                    logoutButton.style.display = 'bloc';
                }

                const loginButton = document.getElementById('login-btn');
                if (loginButton) {
                    loginButton.style.display = 'none';
                }
                const registerButton = document.getElementById('register-btn');
                if (registerButton) {
                    registerButton.style.display = 'none';
                }
                const profileButton = document.getElementById('profile-btn');
                if (profileButton) {
                    profileButton.style.display = 'bloc';
                }
                const payButton = document.getElementById('pay-btn');
                if (payButton) {
                    payButton.style.display = 'bloc';
                }
        }
        else{
             // Hide the logout button after logging out
             const logoutButton = document.getElementById('logout-btn');
                if (logoutButton) {
                    logoutButton.style.display = 'none';
                }

                const loginButton = document.getElementById('login-btn');
                if (loginButton) {
                    loginButton.style.display = 'bloc';
                }
                const registerButton = document.getElementById('register-btn');
                if (registerButton) {
                    registerButton.style.display = 'bloc';
                }
                const profileButton = document.getElementById('profile-btn');
                if (profileButton) {
                    profileButton.style.display = 'none';
                }
                const payButton = document.getElementById('pay-btn');
                if (payButton) {
                    payButton.style.display = 'none';
                }
        }
    },
    methods: {
        async logout() {
            try {
                const token = localStorage.getItem('auth_token');
                await axios.get('/logout', {}, {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                });
                localStorage.removeItem('auth_token');
                localStorage.removeItem('user');
                this.$router.push({ name: 'login' });
                this.user = JSON.parse(localStorage.getItem('user'));
                this.username = this.user ? this.user.name : '';
                        
                // Hide the logout button after logging out
                const logoutButton = document.getElementById('logout-btn');
                if (logoutButton) {
                    logoutButton.style.display = 'none';
                }

                const loginButton = document.getElementById('login-btn');
                if (loginButton) {
                    loginButton.style.display = 'bloc';
                }
                const registerButton = document.getElementById('register-btn');
                if (registerButton) {
                    registerButton.style.display = 'bloc';
                }
                const profileButton = document.getElementById('profile-btn');
                if (profileButton) {
                    profileButton.style.display = 'none';
                }
                const payButton = document.getElementById('pay-btn');
                if (payButton) {
                    payButton.style.display = 'none';
                }
                window.location.reload();
                
                //alert('Logged out successfully');
            } catch (error) {
                console.error(error.response ? error.response.data : error.message);
            }
        }

    }
};
</script>

<style>
.navbar-expand-lg .navbar-nav .nav-link:hover{
    transition: font-weight 0.9s ease; /* Smooth transition for 0.5 seconds */
}
.navbar-expand-lg .navbar-nav .nav-link:hover{
    color: crimson;
    font-weight: bold;
}
.float-right {
  margin-left: auto;
  display: flex;
  margin-left: 600px;
}
.navbar{
    margin-bottom: 30px;
}
</style>