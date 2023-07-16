<template>
    <form class="modal-form" @submit.prevent="login">
        <h5 class="modal-title">Login</h5>
        <div class="alert alert-success" role="alert" v-if="successMessage">
            {{ successMessage }}
        </div>
        <div class="alert alert-danger" role="alert" v-if="errorMessage">
            {{ errorMessage }}
        </div>
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" v-model="email">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" v-model="password">
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="remember" v-model="remember">
            <label class="form-check-label" for="remember">
                Remember me for 2 weeks on this device
            </label>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Login</button>
        </div>
        <div class="form-group">
            <button type="button" class="btn btn-secondary btn-block" @click="cancel">Cancel</button>
        </div>
    </form>
</template>

<script>
import {mapMutations, mapState} from 'vuex';
import {useNotification} from "@kyvg/vue3-notification"
const {notify} = useNotification()

export default {
    data() {
        return {
            email: '',
            password: '',
            remember: false
        };
    },
    computed: {
        ...mapState({
            successMessage: state => state.auth.successMessage,
            errorMessage: state => state.auth.errorMessage,
        }),
    },
    methods: {
        ...mapMutations(['setShowLogin']),
        login() {
            this.$store.dispatch('login', {
                email: this.email,
                password: this.password,
                remember: this.remember
            }).then(() => {
                this.setShowLogin(false);
                notify({
                    title: 'Welcome!!!',
                    type: 'success'
                });
            });
        },
        cancel() {
            this.$emit('close');
        }
    }
};
</script>
