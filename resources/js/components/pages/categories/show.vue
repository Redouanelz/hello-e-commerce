<template>
    <div>
        <div v-if="category" class="row">

        <h4 style="text-align: center">{{ category.name }}</h4>
            <router-link class="nav-link" to="/">Back to Home</router-link>
            <div class="row">
                <div class="col-md-6 offset-3">
                <div class="alert alert-success" role="alert" >
                <p> {{ category.description }}</p>
                </div>
                </div>
            </div>

            <div class="row">
                <h5>Products in this category:</h5>
                <div class="row" v-if="category.products && category.products.length">
                    <div class="col-md-2" v-for="product in category.products" :key="product.id">
                    <img loading="lazy" :src="product.image_url" alt="" width="100%" />
                    <h5>{{ product.name }}</h5>
                    <span style="font-size: 15px;">${{ product.price }}</span> <br />
                    <router-link class="btn btn-sm btn-outline-danger" :to="{ name: 'product.show', params: { id: product.id } }">
                        View Details
                    </router-link>
                    </div>
                </div>
                <div v-else>
                    <p>Products not found...</p>
                </div>
            </div>                   
        </div>
        <div v-else>
            <p>Loading category details...</p>
        </div>
      <br>
      
       <!-- Display products -->
       <div class="row">
               
        </div>
      

        
        
    </div>
</template>
<script>
export default{
    data(){
        return {
            category: null,  // Holds the fetched category data
        }
    },
    mounted () {
        this.getCategory();
    },
    methods : {
        async getCategory() {
            const categoryId = this.$route.params.id; // Get the ID from the route
            try {
                const response = await axios.get(`/api/categories/${categoryId}`); // Make the API call
                this.category = response.data;  // Store the category data
                console.log(this.category.products);
            } catch (error) {
                console.error('Error fetching category:', error);
            }
        }
    }
}

</script>