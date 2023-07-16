import {useNotification} from "@kyvg/vue3-notification"
const {notify} = useNotification()

const state = {
    cartItems: [],
    showCart: false,
};

const getters = {
    cartItems: state => state.cartItems
};

const mutations = {
    addToCart(state, product) {
        const existingProduct = state.cartItems.find(item => item.id === product.id);
        if (existingProduct) {
            if (existingProduct.quantity < product.quantity) {
                existingProduct.quantity++;
                notify({
                    title: 'Product added to cart!!!',
                    type: 'success'
                });
            } else {
                notify({
                    title: 'Cannot add more quantity to cart!',
                    type: 'error'
                });
            }
        } else {
            state.cartItems.push({ ...product, quantity: 1 });
            notify({
                title: 'Product added to cart!!!',
                type: 'success'
            });
        }
    },
    updateCartItem(state, { productId, quantity }) {
        const cartItem = state.cartItems.find(item => item.id === productId);
        if (cartItem) {
            cartItem.quantity = quantity;
        }
    },
    removeFromCart(state, productId) {
        state.cartItems = state.cartItems.filter(item => item.id !== productId);
    },
    setShowCart(state, value) {
        state.showCart = value;
    },
};

const actions = {
    addToCart({ commit }, product) {
        commit('addToCart', product);

    },
    updateCartItem({ commit }, { productId, quantity }) {
        commit('updateCartItem', { productId, quantity });
    },
    removeFromCart({ commit }, productId) {
        commit('removeFromCart', productId);
    }
};

export default {
    state,
    getters,
    mutations,
    actions
};
