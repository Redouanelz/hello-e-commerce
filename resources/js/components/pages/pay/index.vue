<template>
    <div>
      <h4 style="text-align: center">Pay Now</h4>
      <router-link class="nav-link" to="/">Back to Home</router-link>
      <div class="row">
        <div class="col-md-6 offset-3">
          <div class="alert alert-success" role="alert" >
          <p>You can manage your payments here securely. Choose your preferred payment method and complete your purchase with confidence. Additionally, you can access your payment history to review past transactions.</p>
        </div>
        </div>
       </div>
      <br>
  
     <div class="row">
        <div class="col-md-4 offset-4" style="text-align:center;">
            <p>Total Price: $<b>{{ totalPrice }}</b> </p> <!-- Display total price here -->

            <div class="row">
            <div class="col-md-1 "></div>
              <div class="col-md-3">
                <img width="100%" src="/public/icon_paypal.webp" alt="">
              <a @click="addOrder()" target="_blank" class="btn btn-outline-danger btn-sm" href="https://www.paypal.com/ma/home">Select</a>
              </div>
              <div class="col-md-3">
                <img width="100%" src="/public/icon_mastercard.webp" alt="">
                <a @click="addOrder()" target="_blank" class="btn btn-outline-danger btn-sm" href="https://www.mastercard.us/en-us.html">Select</a>
              </div>
              <div class="col-md-3">
                <img width="100%" src="/public/icon_visa.webp" alt="">
                <a @click="addOrder()" target="_blank" class="btn btn-outline-danger btn-sm" href="https://ma.visamiddleeast.com/en_MA">Select</a>
              </div>
         </div>
        </div>
 
     </div>
      <h4 style="text-align: center">Payment history</h4><br>
     <table class="table">
      <tr>
        <td><b>Total amount</b></td>
        <td><b>Status</b></td>
        <td><b>Date & Time</b></td>
      </tr>
      <tr v-for="(item) in orders" :key="item.id">
        <td>${{ item.total_amount }}</td>
        <td><span class="badge badge-primary">{{ item.status }}</span></td>
        <td> {{ formatDate(item.created_at) }}</td>        
      </tr>
     </table>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        orders: [],
        cartItems: [],
        id: 0,
        totalPrice: 0,
      };
    },
  
    mounted() {
      this.getOrders();
      this.getTotalPrice(); // Call to get total price when component is mounted
    },
  
    methods: {

      async getOrders() {
        try {
          this.user = JSON.parse(localStorage.getItem('user'));
          this.id = this.user ? this.user.id : 0;  
          if (this.id !== 0) {
            const response = await axios.get('/api/pay/' + this.id);
            this.orders = response.data;            
          } else {
            this.$router.push({ name: 'login' });
          }        
        } catch (error) {
          console.error('Error fetching orders items:', error);
        }
      },
  
      // Get total price
      async getTotalPrice() {
        try {
          this.user = JSON.parse(localStorage.getItem('user'));
          this.id = this.user ? this.user.id : 0;  
          if (this.id !== 0) {
            const response = await axios.get('/api/cart/' + this.id);
            this.cartItems = response.data;     
          } else {
            this.$router.push({ name: 'login' });
          }        
        } catch (error) {
          console.error('Error fetching cart items:', error);
        }
  
        this.totalPrice = this.cartItems.reduce((total, item) => {
          return total + (item.product.price * item.quantity);
        }, 0).toFixed(2); // Calculate and set total price
      },
  
      // Format date
      formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleString('en-US', {
          day: '2-digit',
          month: '2-digit',
          year: 'numeric',
          hour: '2-digit',
          minute: '2-digit',
          hour12: true
        }).replace(',', ' at');
      },

      async addOrder(){
          axios.post('/api/pay/add', {
              user_id: this.user.id,
              total_amount: this.totalPrice,
          })
          .then(response => {
             alert("Order done successfully.")
             this.$router.push({ name: 'home' });

                axios.post('/api/cart/clear', {
                  user_id: this.user.id,
              })
            })
          .catch(error => {
              console.error('Error');
          });
         
      },



    },
  }
  </script>
  