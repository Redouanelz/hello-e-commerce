<template>
  <div>
    <div class="col-md-6">
      <div class="input-group mb-3" style="margin-left:20px">
        <input id="search-input" type="text" class="form-control" placeholder="Search for a product" aria-label="Recipient's username" aria-describedby="basic-addon2" v-model="searchQuery" />
        <div class="input-group-append">
          <button class="btn btn-outline-danger" type="button">
            Search
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
              <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Products List -->
    <div v-if="limitedFilteredProducts.length > 0"> <!-- Show filtered and limited products -->
      <h4 style="text-align: center">Our Products</h4>
      <div class="row" style="text-align: center;">
        <div class="col-md-2" v-for="product in limitedFilteredProducts" :key="product.id">
          <img loading="lazy" :src="product.image_url" alt="" width="100%" />
          <h5>{{ product.name }}</h5>
          <span style="font-size: 15px;">${{ product.price }}</span> <br />
          <router-link class="btn btn-sm btn-outline-danger" :to="{ name: 'product.show', params: { id: product.id } }">
            View Details
          </router-link>
        </div>
      </div>
    </div>
    <div v-else>
      <p>No products match your search. Try adjusting your search or <router-link to="/categories">browse all categories</router-link></p>
    </div>

    <!-- Show More Button -->
    <div class="text-center mt-4">
      <button v-if="showMoreAvailable" @click="showMore" class="btn btn-danger">
        Show More
      </button>
    </div>

    <div style="margin-top: 150px;"></div>

    <h4 style="text-align: center">Our Categories</h4>
    <div v-if="categories.length === 0">
      <p>No categories found.</p>
    </div>

    <div class="row">
       <!-- Loop through the categories and display each one -->
      <div class="category-card col-md-3" v-for="category in categories" :key="category.id" >
        <div class="category-details  ">
          <h4>{{ category.name }}</h4>

          <!-- Display the category image -->
          <img loading="lazy" :src="category.image" alt="Category Image" class="category-image" v-if="category.image">

          <!-- Optionally display category description -->
          <p>{{ category.description }}</p>

          <router-link class=" btn btn-outline-danger" :to="`/categories/${category.id}`">View products</router-link>

        </div>
      </div>
    </div>

    <div style="margin-top: 150px;"></div>
    <h4 style="text-align: center">Testimonials</h4>
    <div>
      <section style="color: #000; ">
        <div class="container py-5">
          <div class="row d-flex justify-content-center">
            <div class="col-md-10 col-xl-8 text-center">
            
            </div>
          </div>

          <div class="row text-center">
            <div class="col-md-4 mb-4 mb-md-0">
              <div class="card">
                <div class="card-body py-4 mt-2">
                  <div class="d-flex justify-content-center mb-4">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp"
                      class="rounded-circle shadow-1-strong" width="100" height="100" />
                  </div>
                  <h5 class="font-weight-bold">Teresa May</h5>
                  <h6 class="font-weight-bold my-3">On products</h6>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                
                  <p class="mb-2">
                    <i class="fas fa-quote-left pe-2"></i>Lorem ipsum dolor sit amet,
                    consectetur adipisicing elit. Quod eos id officiis hic tenetur quae quaerat
                    ad velit ab hic tenetur.
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-4 mb-md-0">
              <div class="card">
                <div class="card-body py-4 mt-2">
                  <div class="d-flex justify-content-center mb-4">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(15).webp"
                      class="rounded-circle shadow-1-strong" width="100" height="100" />
                  </div>
                  <h5 class="font-weight-bold">Maggie McLoan</h5>
                  <h6 class="font-weight-bold my-3">About payments</h6>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <p class="mb-2">
                    <i class="fas fa-quote-left pe-2"></i>Autem, totam debitis suscipit saepe
                    sapiente magnam officiis quaerat necessitatibus odio assumenda perferendis
                    labore laboriosam.
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-0">
              <div class="card">
                <div class="card-body py-4 mt-2">
                  <div class="d-flex justify-content-center mb-4">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(17).webp"
                      class="rounded-circle shadow-1-strong" width="100" height="100" />
                  </div>
                  <h5 class="font-weight-bold">Alexa Horwitz</h5>
                  <h6 class="font-weight-bold my-3">UI/UX</h6>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <p class="mb-2">
                    <i class="fas fa-quote-left pe-2"></i>Cras sit amet nibh libero, in gravida
                    nulla metus scelerisque ante sollicitudin commodo cras purus odio,
                    vestibulum in tempus viverra turpis.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
       
    </div>
</template>


<script>
import axios from 'axios';

export default {
  data() {
    return {
      products: [],
      categories: [],
      searchQuery: '', // Search input value
      limit: 10, // Initial number of products to display
    };
  },
  mounted() {
    this.getProducts();
    this.getCategories();
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
    async getCategories() {
      try {
        const response = await axios.get('api/categories');
        this.categories = response.data;
      } catch (error) {
        console.error('Error fetching categories:', error);
      }
    },
    // Method to load more products
    showMore() {
      this.limit += 10; // Increase the limit by 10 each time
    },
  },
  computed: {
    // Computed property to filter products based on the searchQuery
    filteredProducts() {
      return this.products.filter((product) => {
        const searchText = this.searchQuery.toLowerCase();
        return (
          product.name.toLowerCase().includes(searchText) ||
          product.description.toLowerCase().includes(searchText)
        );
      });
    },
    // Compute the limited products based on the limit value
    limitedFilteredProducts() {
      return this.filteredProducts.slice(0, this.limit);
    },
    // Check if there are more products to show
    showMoreAvailable() {
      return this.filteredProducts.length > this.limit;
    },
  },
};
</script>

<style>
.category-card {
  border: 1px solid #ddd;
  padding: 15px;
}

.category-image {
  width: 100%;
  height: auto;
  display: block;
  margin: 10px 0;
}
</style>