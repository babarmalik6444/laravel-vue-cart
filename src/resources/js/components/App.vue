<template>
    <div class="container">
        <Nav></Nav>
        <ProductsGrid></ProductsGrid>
        <notifications position="top center"/>
    </div>
</template>

<script>
import {defineComponent} from 'vue'
import {useStore} from 'vuex'
import Nav from "./partials/Nav.vue"
import ProductsGrid from "./Products/ProductsGrid.vue";

export default defineComponent({
    name: 'App',
    components: {
        Nav,
        ProductsGrid
    },
    setup() {
        const store = useStore()
        return {
            store
        }
    },
})
</script>
