<template>
    <div>
        <h4 style="text-align: center">Categories</h4>
      <router-link class="nav-link" to="/">Back to Home</router-link>
      <div class="row">
        <div class="col-md-6 offset-3">
          <div class="alert alert-success" role="alert" >
          <p>To make your shopping experience even more convenient, we’ve organized our wide range of products into easy-to-navigate categories. Whether you're looking for specific items or just browsing, our categories help you find what you need quickly and efficiently.</p>
        </div>
        </div>
       </div>
      <br>
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
    </div>
</template>
<script>
export default {
    data() {
    return {
      categories: [],     
    };
  },
  mounted() {
    this.getCategories();
  },
  methods:{
    async getCategories() {
      try {
        const response = await axios.get('api/categories');
        this.categories = response.data;
      } catch (error) {
        console.error('Error fetching categories:', error);
      }
    },
  }
}
</script>