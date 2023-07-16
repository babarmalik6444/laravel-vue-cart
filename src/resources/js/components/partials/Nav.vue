<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">My Store</a>
        <button
            class="navbar-toggler"
            type="button"
            @click="toggleCollapse"
            :aria-expanded="isCollapsed ? 'false' : 'true'"
            aria-controls="navbarSupportedContent"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" :class="{ 'show': !isCollapsed }" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto" v-if="user">
                <li class="nav-item">
                    <a class="nav-link" href="#">Welcome {{ user.name }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" @click="logout">Log out</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto" v-else>
                <li class="nav-item">
                    <a class="nav-link" href="#" @click="showLoginModal">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" @click="showSignupModal">Signup</a>
                </li>
            </ul>

            <div class="cart-icon" @click="showCartModal">
                <i class="bi bi-cart-fill"></i>
                <span class="cart-count">{{ cartItemCount }}</span>
            </div>
        </div>

        <!-- Login Form -->
        <div v-if="showLogin" class="form-overlay form-modal">
            <LoginForm @close="hideLoginModal" />
        </div>

        <!-- Signup Form -->
        <div v-if="showSignup" class="form-overlay form-modal">
            <SignupForm @close="hideSignupModal" />
        </div>

        <!-- Cart Modal -->
        <div v-if="showCart" class="cart-overlay">
            <Cart @close="hideCartModal" />
        </div>
    </nav>
</template>

<script>
import { mapState, mapMutations } from 'vuex';
import LoginForm from './LoginForm.vue';
import SignupForm from './SignupForm.vue';
import Cart from './Cart.vue';
import {useNotification} from "@kyvg/vue3-notification"
const {notify} = useNotification()

export default {
    components: {
        LoginForm,
        SignupForm,
        Cart,
    },
    data() {
        return {
            isCollapsed: true,
        };
    },
    computed: {
        ...mapState({
            showLogin: state => state.auth.showLogin,
            showSignup: state => state.auth.showSignup,
            showCart: state => state.cart.showCart,
            user: state => state.auth.user,
        }),
        cartItemCount() {
            return this.$store.getters['cartItems'].length;
        },
    },
    methods: {
        ...mapMutations(['setShowLogin', 'setShowSignup' , 'setShowCart']),
        toggleCollapse() {
            this.isCollapsed = !this.isCollapsed;
        },
        showLoginModal() {
            this.setShowLogin(true);
        },
        hideLoginModal() {
            this.setShowLogin(false);
        },
        showSignupModal() {
            this.setShowSignup(true);
        },
        hideSignupModal() {
            this.setShowSignup(false);
        },
        showCartModal() {
            this.setShowCart(true);
        },
        hideCartModal() {
            this.setShowCart(false);
        },
        logout() {
            this.$store.dispatch('logout')
                .then(() => {
                    notify({
                        title: 'Logout!!!',
                        type: 'success'
                    });
            });
        },

    },
};
</script>

<style scoped>
.cart-icon {
    position: relative;
    margin-left: auto;
    cursor: pointer;
}

.cart-link {
    display: flex;
    align-items: center;
    text-decoration: none;
    color: inherit;
}

.cart-count {
    position: absolute;
    top: -8px;
    right: -8px;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 20px;
    height: 20px;
    background-color: red;
    color: white;
    font-size: 12px;
    border-radius: 50%;
}

i {
    font-size: 20px;
}

.cart-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 999;
}
</style>
