<template>
    <div class="modal-card white-card">
        <header class="modal-card-head">
            <p class="modal-card-title">Login</p>
        </header>
        <section class="modal-card-body ">
            <b-field label="Name">
                <b-input type="text" v-model="name" placeholder="Your name" required></b-input>
            </b-field>

            <b-field label="Email">
                <b-input type="email" v-model="email" placeholder="Your email" required></b-input>
            </b-field>

            <b-field label="Password">
                <b-input
                        type="password"
                        v-model="password"
                        password-reveal
                        placeholder="Your password"
                        required
                ></b-input>
            </b-field>

            <b-field label="Password">
                <b-input
                        type="password"
                        v-model="passwordConfirmation"
                        password-reveal
                        placeholder="Write your password again"
                        required
                        @keyup.enter="registerClient"
                ></b-input>
            </b-field>

            <b-checkbox>Remember me</b-checkbox>

        </section>
        <footer class="modal-card-foot">
            <button class="button" type="button" @click="$parent.close()">Close</button>
            <button class="button is-primary" @click="registerClient">Register</button>
        </footer>
    </div>
</template>

<script>
    import {TASKLAND_CONFIG} from '../config.js';

    export default {
        data() {
            return {
                name: 'bbb',
                email: 'bbb@bbb.com',
                password: 'bbbbbb',
                passwordConfirmation: 'bbbbbb',
                userj: ''
            }
        },
        methods: {
            registerClient: function () {
                axios.post(TASKLAND_CONFIG.API_URL + '/newUser', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    passwordConfirmation: this.passwordConfirmation,
                })
                    .then(() => {
                        this.$store.dispatch('loginUser', { email : this.email, password : this.password} )
                    })

            }
        },

    };
</script>

<style scoped>
    .white-card {
        background-color: white;
        border-radius: 7px;
        width: 100%;
        max-width: 600px;
    }


</style>
