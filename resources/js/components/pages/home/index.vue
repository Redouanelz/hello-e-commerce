<template>    
    <div>
       <div class="col-md-4">
            <div class="input-group    mb-3" style="margin-left:20px">
            <input id="search-input" type="text" class="form-control" placeholder="Search for a product" aria-label="Recipient's username" aria-describedby="basic-addon2" v-model="searchQuery">
            <div class="input-group-append">
                <button   class="btn  btn-outline-danger" type="button">Search  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/></svg>
                </button>
            </div>
            </div>
       </div>

        <!-- Products List -->
      <div v-if="filteredProducts.length > 0"> <!-- Show filteredProducts -->
        <h4 style="text-align: center">Our Products</h4>

        <div class="row" style="text-align: center;">
          <div class="col-md-2" v-for="product in filteredProducts" :key="product.id"> <!-- Loop through filteredProducts -->
            <img :src="product.image_url" alt="" width="100%">
            <h5>{{ product.name }}</h5>
            <span style="font-size: 15px;">${{ product.price }}</span> <br>
            <router-link class="btn btn-sm btn-outline-danger" :to="{ name: 'product.show', params: { id: product.id } }">
              View Details
            </router-link>        
          </div>
        </div>
      </div>
      <div v-else>
      <p>No products found.</p>
      </div>


      <!--
      <h4 style="text-align: center">Our Products</h4>
    <div v-if="products.length > 0">

      <div class="row" style="text-align: center;">
        <div class="col-md-2" v-for="product in products" :key="product.id">
          <img :src="product.image_url" alt="" width="100%">
            <h5>{{ product.name }}</h5>
          <span style="font-size: 15px;">${{ product.price }}</span> <br>
          <router-link class="btn btn-sm  btn-outline-danger" :to="{ name: 'product.show', params: { id: product.id } }">View Details</router-link>        </div>
      </div>
    </div>
    <div v-else>
      <p>No products found.</p>
    </div>
    -->

    <h4 style="text-align: center">Our Categorys</h4>

       <div class="row">
        <div class="col-md-4">
            <img width="100%" src="/public/icon_a.png" alt="">
        </div>
        <div class="col-md-4">
            <img width="100%" src="/public/icon_b.png" alt="">
        </div>
        <div class="col-md-4">
            <img width="100%" src="/public/icon_c.png" alt="">
        </div>
       </div>
    </div>
</template>


<script>
import axios from 'axios';

export default {
  data() {
    return {
      products: [],  
      searchQuery: '', // Search input value
    };
  },
  mounted() {
    this.getProducts();
        // Parse the user data from localStorage
      },
  methods: {
    async getProducts() {
      try {
        const response = await axios.get('api/products');
        this.products = response.data;
      } catch (error) {
        console.error('Error fetching products:', error);
      }
    },
    
  },

  computed: {
    // Computed property to filter products based on the searchQuery
    filteredProducts() {
      return this.products.filter(product => {
        const searchText = this.searchQuery.toLowerCase();
        return (
          product.name.toLowerCase().includes(searchText) ||
          product.description.toLowerCase().includes(searchText)
        );
      });
    },
  },

};
</script>
