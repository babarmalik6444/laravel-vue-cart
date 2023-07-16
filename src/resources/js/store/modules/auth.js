import axios from 'axios';
import Cookies from 'js-cookie';

const state = {
    user: null,
    errorMessage: '',
    successMessage: '',
    showLogin: false,
    showSignup: false,
};

const mutations = {
    SET_USER(state, user) {
        state.user = user;
    },
    SET_ERROR_MESSAGE(state, message) {
        state.errorMessage = message;
    },
    SET_SUCCESS_MESSAGE(state, message) {
        state.successMessage = message;
    },
    CLEAR_MESSAGES(state) {
        state.errorMessage = '';
        state.successMessage = '';
    },
    setShowLogin(state, value) {
        state.showLogin = value;
    },
    setShowSignup(state, value) {
        state.showSignup = value;
    },
};


const actions = {
    async signup({ commit }, userData) {
        try {
            await axios.post('/api/user/create', userData);
                commit('CLEAR_MESSAGES');
                commit('SET_SUCCESS_MESSAGE', 'Signup successful!');
                return Promise.resolve();
        } catch (error) {
            const message = error.response && error.response.data ? error.response.data : 'Signup failed.';
            commit('CLEAR_MESSAGES');
            commit('SET_ERROR_MESSAGE', message);
            return Promise.reject(message);
        }
    },
    async login({ commit }, userData) {
        try {
            const response = await axios.post('/api/login', userData);
            const user = response.data.user;

            // Set the auth token and user information in cookies
            if (userData.remember) {
                Cookies.set('authToken', user.token, { expires: 14 }); // Expires in 14 days
                Cookies.set('user', JSON.stringify(user), { expires: 14 });
            }

            commit('SET_USER', user);
            commit('CLEAR_MESSAGES');
            commit('SET_SUCCESS_MESSAGE', 'Login successful!');
            return Promise.resolve();
        } catch (error) {
            const message = error.response && error.response.data.message ? error.response.data.message : 'Login failed.';
            commit('CLEAR_MESSAGES');
            commit('SET_ERROR_MESSAGE', message);
            return Promise.reject(message);
        }
    },
    async logout({ commit, state }) {
        try {
            const config = {
                headers: {
                    Authorization: `Bearer ${state.user.token}`,
                },
            };
            console.log(config);
            await axios.post('/api/logout', null, config);

            Cookies.remove('authToken');
            Cookies.remove('user');

            commit('SET_USER', null);
            commit('CLEAR_MESSAGES');

            return Promise.resolve();
        } catch (error) {
            const message = error.response && error.response.data ? error.response.data : 'Logout failed.';
            commit('SET_ERROR_MESSAGE', message);
            return Promise.reject(message);
        }
    },
};


export default {
    state,
    mutations,
    actions
};
