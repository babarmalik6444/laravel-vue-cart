import {useNotification} from "@kyvg/vue3-notification"
import { addToCartHelper, removeFromCartHelper } from "../../helpers/cart_helper.js"
const {notify} = useNotification()

const state = {
    cartItems: [],
    showCart: false,
};

const getters = {
    cartItems: state => state.cartItems
};

const mutations = {
    addToCart(state, { product, user }) {
        const existingProduct = state.cartItems.find(item => item.id === product.id);
        if (existingProduct) {
            if (existingProduct.quantity < product.quantity) {
                existingProduct.quantity++;
                addToCartHelper(user, existingProduct.id, existingProduct.quantity);

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
            state.cartItems.push({ ...product, quantity: 1, left_items: product.quantity });
            addToCartHelper(user, product.id, 1);

            notify({
                title: 'Product added to cart!!!',
                type: 'success'
            });
        }
    },
    updateCartItem(state, { productId, quantity, user }) {
        const cartItem = state.cartItems.find(item => item.id === productId);

        if (cartItem && cartItem.quantity < cartItem.left_items) {
            cartItem.quantity = quantity;
            addToCartHelper(user, productId, cartItem.quantity);
        } else {
            notify({
                title: 'Cannot add more quantity to cart!',
                type: 'error'
            });
        }
    },
    removeFromCart(state, { productId, user }) {
        state.cartItems = state.cartItems.filter(item => item.id !== productId);
        removeFromCartHelper(user, productId);
    },
    setShowCart(state, value) {
        state.showCart = value;
    },
};

const actions = {
    addToCart({ commit, rootState }, product) {
        commit('addToCart', { product, user: rootState.auth.user });
    },
    updateCartItem({ commit, rootState }, { productId, quantity }) {
        commit('updateCartItem', { productId, quantity, user: rootState.auth.user });
    },
    removeFromCart({ commit, rootState }, productId) {
        commit('removeFromCart', { productId,  user: rootState.auth.user });
    }
};

export default {
    state,
    getters,
    mutations,
    actions
};
