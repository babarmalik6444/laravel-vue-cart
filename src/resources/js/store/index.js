import { createStore } from 'vuex';
import createPersistedState from 'vuex-persistedstate';
import auth from './modules/auth';
import cart from './modules/cart';
import Cookies from 'js-cookie';

const persistedState = createPersistedState({
    expires: 24 * 60 * 60 * 1000, // Set expiration for one day
});

const store = createStore({
    modules: {
        auth,
        cart
    },
    plugins: [persistedState]
});

// Check if the auth token and user information exist in cookies on page load
const authToken = Cookies.get('authToken');
const user = Cookies.get('user');
if (authToken && user) {
    store.commit('SET_USER', JSON.parse(user));
}

export default store;
