<template>
    <div class="">
        <div class="modal-card white-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Login</p>
            </header>
            <section class="modal-card-body is-fullwidth">
                <b-field label="Email">
                    <b-input class="" type="email" v-model="email" placeholder="Your email"></b-input>
                </b-field>

                <b-field label="Password" @keyup.enter.native="loginStandard">
                    <b-input
                            type="password"
                            v-model="password"
                            password-reveal
                            placeholder="Your password"

                    ></b-input>
                </b-field>

                <b-checkbox>Remember me</b-checkbox>
            </section>
            <footer class="modal-card-foot">
                <button class="button" type="button" @click="$parent.close()">Close</button>
                <button class="button is-primary" @click="loginStandard">Login</button>
                <a class="button is-dark has-text-white is-pulled-right" style="margin-left: auto" href="/login/github">
                    Login with Github</a>
            </footer>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                email: 'bbb@bbb.com',
                password: 'bbbbbb',
            }
        },
        methods: {
            loginStandard: function () {
                this.$store.dispatch('loginUser', {
                    email: this.email,
                    password: this.password
                })
                    .then()
                    .catch(error => console.log(error))

            },
            aa : function () {
                this.$store.dispatch('loginwithgithub')
            }

        }
    };
</script>

<style>

    .white-card {
        width: 100%;
        background-color: white;
        border-radius: 7px;
    }


</style>
