<template>
    <form class="modal-form" @submit.prevent="signup">
        <h5 class="modal-title">Signup</h5>
        <div class="alert alert-danger" role="alert" v-if="errorMessage.message">
            {{ errorMessage.message }}
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" v-model="name" />
            <small class="text-danger" v-if="errorMessage.errors?.name" v-for="error in errorMessage.errors.name">{{ error }}<br/></small>
        </div>
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" v-model="email" />
            <small class="text-danger" v-if="errorMessage.errors?.email" v-for="error in errorMessage.errors.email">{{ error }}<br/></small>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" v-model="password" />
            <small class="text-danger" v-if="errorMessage.errors?.password" v-for="error in errorMessage.errors.password">{{ error }}<br/></small>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Signup</button>
        </div>
        <div class="form-group">
            <button type="button" class="btn btn-secondary btn-block" @click="cancel">Cancel</button>
        </div>
    </form>
</template>

<script>
import {mapMutations, mapState} from 'vuex';

export default {
    data() {
        return {
            name: '',
            email: '',
            password: '',
        };
    },
    computed: {
        ...mapState({
            errorMessage: state => state.auth.errorMessage,
            showLogin: state => state.auth.showLogin,
            showSignup: state => state.auth.showSignup,
        }),
    },
    methods: {
        ...mapMutations(['setShowLogin', 'setShowSignup']),
        signup() {
            this.$store.dispatch('signup', {
                name: this.name,
                email: this.email,
                password: this.password,
            }).then(() => {
                this.setShowLogin(true);
                this.cancel();
            });
        },
        clearForm() {
            this.name = '';
            this.email = '';
            this.password = '';
            this.errorMessage = '';
        },
        cancel() {
            this.setShowSignup(false);
            this.clearForm();
        },
    },
};
</script>
