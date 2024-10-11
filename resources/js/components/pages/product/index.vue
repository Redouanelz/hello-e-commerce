<template>
    <div>
        <h4 style="text-align: center">Product</h4>
            <router-link class="nav-link" to="/">Back to Home</router-link>
        <div v-if="product">
            <div class="row">
                <div class="col-md-6">
                    <img :src="product.image_url" alt="Product Image" class="img-fluid" />                    
                </div>
                <div class="col-md-6">
                    <br><br><br>
                    <h3>{{ product.name }}</h3>
                    <p>{{ product.description }}</p>
                    <hr>
                    <p style="font-size: 30px;">${{ product.price }}</p>
                   <div v-if="this.user">
                     <button @click="addToCartBuy" class="btn btn-xs btn-danger" >Buy Now</button>
                    
                      <button @click="addToCart" class="btn btn-xs btn-outline-danger" style="margin-left: 20px;" >Add to Cart
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16"><path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/></svg>
                      </button>
                   </div>

                   <div v-else>
                    
                    <button disabled class="btn btn-xs btn-danger">Buy Now</button>

                    <button disabled class="btn btn-xs btn-outline-danger" style="margin-left: 20px;" >Add to Cart
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16"><path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/></svg>
                    </button>
                    <hr>
                    <p>Please log in to your account to continue with your purchase on Hello.com. We want to ensure a smooth and secure checkout experience for you.</p>
                    <router-link class=" btn btn-xs btn-danger" to="/login">Login</router-link>
                   </div>
                    
                </div>
            </div>
        </div>

        <div v-else>
        <p>Loading product...</p>
        </div>

        <hr>
        <h4 style="text-align: center">Reviews</h4>
        <div class="row" style="text-align: ">
          <div class="col-md-4">
            <h5 style="text-align: ">Add your review</h5>
            <form  @submit.prevent="addReview" >
              <textarea required placeholder="Write your review on this product" class="form-control" v-model="review_description" name="review_description" id=""></textarea>
              <br>
              <input type="hidden" v-model="this.id" />
              <label for="">Give your review note</label>
             
              <div class="star-rating" style="font-size:13px">
                <i 
                  v-for="star in 5" 
                  :key="star" 
                  :class="{'bi bi-star-fill': star <= review_note, 'bi bi-star': star > review_note}"
                  @mouseover="hoverRating(star)"
                  @mouseleave="resetRating"
                  @click="setRating(star)"
                  style="cursor: pointer; font-size: 2em; color: gold;">
                </i>
              </div>                  
              <br>
              <input type="submit" class="btn btn-outline-danger" value="Send the review">
            </form>
          </div>
          <div class="col-md-6 offset-1">
              <h5 style="text-align:center">Client's reviews</h5>
              <div v-if="avis && avis.length > 0">
              <div v-for="(review, index) in avis" :key="index" class="review-item">
                <h5>Review #{{ index + 1 }}</h5>
               <!-- Star Rating -->
              <div class="star-rating" style="font-size:8px">
                  <i 
                    v-for="star in 5" 
                    :key="star"
                    :class="{'bi bi-star-fill': star <= review.note, 'bi bi-star': star > review.note}"
                    style="font-size: 2em; color: gold;">
                  </i>
                </div>

                <p> {{ review.description }}</p>
                <hr />
              </div>
            </div>
            <div v-else>
              <p>No reviews available for this product.</p>
            </div>
          
            </div>

        </div>

    </div>
</template>


<script>
import axios from 'axios';
import { mapGetters } from 'vuex';

export default {
  data() {
    return {
      product: null,
      avis: null,

      review_description:'',
      review_note: 0,
      hover_note: 0,  // Keeps track of hovered stars
    };
  },
  props: {
    id: {
      type: String,
      required: true,
    },
  },
  mounted() {
    this.getProduct();
    this.getAvis();
  },
  computed: {
    ...mapGetters(['getUser']),
    user() {
      return this.getUser; // Get user from Vuex state
    },
    error() {
      return this.$store.state.error; // Access error directly
    }
  },
  methods: {
    async getProduct() {
      try {
        const response = await axios.get(`/api/product/${this.id}`);
        this.product = response.data;
      } catch (error) {
        console.error('Error fetching product:', error);
      }
    },
    async getAvis() {
      try {
        const res = await axios.get(`/api/avis/${this.id}`);
        this.avis = res.data;
      } catch (error) {
        console.error('Error:', error);
      }
    },
    addToCart() {  
    try {
          // Send POST request with both product ID and user ID as parameters
          axios.post('/api/cart/add', {
            product_id: this.id,
            user_id: this.user.id
          })
          .then((response) => {
            // Handle the response (e.g., update the cart or show a success message)
            //alert('Product added to cart');
            this.product = response.data;
            this.$router.push({ name: 'cart.show' });

          })
          .catch((error) => {
            alert.error('Error adding product to cart:', error);
          });
          
        } catch (error) {
          alert.error('Error adding to cart:', error);
        }
      },

    addToCartBuy() {  
     try {
         // Send POST request with both product ID and user ID as parameters
         axios.post('/api/cart/add', {
           product_id: this.id,
           user_id: this.user.id
         })
         .then((response) => {
           // Handle the response (e.g., update the cart or show a success message)
           //alert('Product added to cart');
           this.product = response.data;
           this.$router.push({ name: 'pay' });

         })
         .catch((error) => {
           alert.error('Error adding product to cart:', error);
         });
         
       } catch (error) {
         alert.error('Error adding to cart:', error);
       }
     },

    async addReview(event) {
      try {
        // Send a POST request to the backend with the form data
        const response = await axios.post('/api/avis/add', {
          description: this.review_description,
          note: this.review_note,
          id_product: this.id,
        });

        // Log success or handle it as needed
        alert(response.data.message);
        this.review_description = "";
        this.review_note = 0;
      } catch (error) {
        // Handle validation or other errors
        console.error('Error', error.response.data);
      }
    },

    // When user hovers over a star
    hoverRating(star) {
      this.hover_note = star;
    },
    // When user leaves the star area
    resetRating() {
      this.hover_note = 0;
    },
    // When user clicks on a star to set the rating
    setRating(star) {
      this.review_note = star;
    },


  },
};
</script>