<template>
    <div>
        <h4 style="text-align: center">Your Cart</h4><br>
        <router-link class="nav-link" to="/">Back to Home</router-link>
        <div  style="text-align:center"> {{ cartItems.length }} product(s)</div>
        <br>
      <div v-if="cartItems.length > 0" class="row">
        <div class="col-md-3" style="text-align: center">
          <h4 >Cart total</h4>
          <p>Total Price: $<b>{{ getTotalPrice() }}</b></p>
          <router-link class=" btn btn-danger" to="/pay">Buy Now</router-link>
          <hr>
          <div class="row">
            <div class="col-md-1"></div>
              <div class="col-md-3">
                <img width="100%" src="/public/icon_paypal.webp" alt="">
              </div>
              <div class="col-md-3">
                <img width="100%" src="/public/icon_mastercard.webp" alt="">
              </div>
              <div class="col-md-3">
                <img width="100%" src="/public/icon_visa.webp" alt="">
              </div>
            </div>
        </div>
        <div  v-for="(item) in cartItems" :key="item.id" class="col-md-2 cart-item">          
          <!-- Access the product data -->           
          <h5>{{ item.product.name }}</h5>
          <img :src="item.product.image_url" alt="Product Image" class="img-fluid" />          
          <p>${{ item.product.price }}</p>
          <button @click="addCartQuantity(item.product.id)" 
          class="btn btn-sm btn-outline-default"  >
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
          </svg>
          </button>
          <b class="btn btn-sm btn-default">{{ item.quantity }}</b>
          <button @click="removeCartQuantity(item.product.id)" 
          class="btn btn-sm btn-outline-default"  >
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-circle" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
            <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8"/>
          </svg>
          </button>     
          <hr>  
          <button @click="removeFromCart(item.product.id )" class="btn btn-sm btn-danger" style="margin-left: 20px;" >
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
              <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
              <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
            </svg>
          </button>
          <router-link style="margin-left:10px" class="btn btn-sm  btn-outline-danger" :to="{ name: 'product.show', params: { id: item.product_id } }">View Details</router-link>     
          

        </div>
      </div>
  
      <div v-else>
        <p>No items in cart.</p>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        cartItems: [],
        id:0,
        totalPrice: 0,
      };
    },
    mounted() {
      this.getCartItems();
    },
    methods: {
      async getCartItems() {
        try {
          this.user = JSON.parse(localStorage.getItem('user'));
          this.id = this.user ? this.user.id : 0;  
          if(this.id != 0 ){
            const response = await axios.get('/api/cart/'+this.id); // Replace with your API URL
            this.cartItems = response.data;            
          }
          else{
            this.$router.push({ name: 'login' });
          }        
        } catch (error) {
          console.error('Error fetching cart items:', error);
        }
      },

      removeFromCart(productId) {
          axios.post('/api/cart/remove', {
              product_id: productId,
              user_id: this.user.id
          })
          .then(response => {
              // Optionally, remove the item from the cart in the frontend state
              this.cartItems = this.cartItems.filter(item => item.product_id !== productId);
             // window.location.reload();
            })
          .catch(error => {
              console.error('Error removing product from cart:');
          });
      },
      // Increase Quantity
      addCartQuantity(productId) {
      axios.post('/api/cart/addquantity', {
        product_id: productId,
        user_id: this.user.id
      })
      .then(response => {
        // Update the cart items locally
        const item = this.cartItems.find(item => item.product.id === productId);
        if (item) {
          item.quantity += 1;
        }
      })
      .catch(error => {
        console.error('Error increasing product quantity:', error);
      });
    },

    // Decrease Quantity
    removeCartQuantity(productId) {
      axios.post('/api/cart/removequantity', {
        product_id: productId,
        user_id: this.user.id
      })
      .then(response => {
        // Update the cart items locally
        const item = this.cartItems.find(item => item.product.id === productId);
        if (item && item.quantity > 1) {
          item.quantity -= 1;
        }
      })
      .catch(error => {
        console.error('Error decreasing product quantity:', error);
      });
    },

    getTotalPrice() {
        this.totalPrice = 0,
              this.cartItems.forEach(item => {
                console.log(item);
          this.totalPrice += item.product.price * item.quantity; // Calculate total for each item
        });

        return this.totalPrice.toFixed(2); // Return the total sum
        },
    }
  };
  </script>
  
  <style scoped>
    .cart-item {
      border: 1px solid #ccc;
      padding: 10px;
      margin-bottom: 10px;
    }
  
    img {
      max-width: 100%;
      height: auto;
    }
  </style>
  