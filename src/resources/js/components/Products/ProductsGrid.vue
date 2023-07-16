<template>
    <div class="container mt-4">
        <h3>Products</h3>

        <div class="row">
            <div v-for="product in products" :key="product.id" class="col-md-3">
                <div class="card mb-4">
                    <img class="card-img-top" src="https://via.placeholder.com/200" alt="Product Image">
                    <div class="card-body">
                        <h5 class="card-title">{{ product.name }}</h5>
                        <a href="#" class="badge text-bg-dark">${{ product.price }}</a>
                        <a href="#" class="badge text-bg-dark mx-2">{{ product.quantity }} left</a>
                        <p class="card-text">{{ product.description }}</p>
                        <button class="btn btn-outline-primary btn-sm" @click="addToCart(product)">Add to Cart</button>
                    </div>
                </div>
            </div>
        </div>

        <nav v-if="pagination && pagination.last_page > 1">
            <ul class="pagination">
                <li class="page-item" :class="{ disabled: !pagination.prev_page_url }">
                    <a class="page-link" @click.prevent="fetchProducts(pagination.current_page - 1)" href="#">Previous</a>
                </li>
                <li v-for="page in pagination.last_page" :key="page" class="page-item" :class="{ active: page === pagination.current_page }">
                    <a class="page-link" @click.prevent="fetchProducts(page)" href="#">{{ page }}</a>
                </li>
                <li class="page-item" :class="{ disabled: !pagination.next_page_url }">
                    <a class="page-link" @click.prevent="fetchProducts(pagination.current_page + 1)" href="#">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    data() {
        return {
            products: [],
            pagination: null,
        };
    },
    mounted() {
        this.fetchProducts(1);
    },
    methods: {
        fetchProducts(page) {
            axios.get(`api/products?page=${page}`)
              .then(response => {
                this.products = response.data.data;
                this.pagination = response.data;
              })
              .catch(error => {
                console.error(error);
              });
        },
        addToCart(product) {
            this.$store.dispatch('addToCart', product);
        }
    }
};
</script>

<style scoped>
/* Add any custom styles for the products grid */
</style>
