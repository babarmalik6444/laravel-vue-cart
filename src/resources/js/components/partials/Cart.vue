<template>
    <div class="cart-container">
        <h2>Cart</h2>
        <div v-if="cartItems.length === 0">
            <p>Your cart is empty.</p>
        </div>
        <table class="table table-hover" v-else>
            <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in cartItems" :key="item.id">
                <td>{{ item.name }}</td>
                <td>${{ item.price }}</td>
                <td>
                    <input type="number" v-model="item.quantity" min="1" @change="updateQuantity(item)" />
                </td>
                <td>${{ (item.price * item.quantity).toFixed(2) }}</td>
                <td>
                    <button class="btn btn-danger btn-sm mt-0" @click="removeItem(item.id)">X</button>
                </td>
            </tr>
            </tbody>
        </table>

        <div class="cart-actions">
            <button v-if="cartItems.length !== 0" class="btn btn-outline-primary btn-sm">Place Order</button>
            <button class="btn btn-outline-primary btn-sm mx-3" @click="closeCart">Continue Shopping</button>
        </div>
    </div>
</template>

<script>
export default {
    computed: {
        cartItems() {
            return this.$store.getters['cartItems'];
        }
    },
    methods: {
        updateQuantity(item) {
            this.$store.dispatch('updateCartItem', {
                productId: item.id,
                quantity: item.quantity,
            });
        },
        removeItem(productId) {
            this.$store.dispatch('removeFromCart', productId);
        },
        closeCart() {
            this.$emit('close');
        }
    }
};
</script>

<style scoped>
.cart-container {
    margin: 20px;
    background: white;
    padding: 10px;
    border-radius: 5px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th,
td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ccc;
}

.btn-danger {
    margin-top: 10px;
}

.cart-actions {
    display: flex;
    justify-content: flex-end;
    margin-top: 10px;
}
</style>
