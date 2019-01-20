<template>
    <div class="columns is-flex is-vcentered has-background-grey-light">
        <div class="column is-12  ">



                    <section class="hero is-info">
                        <div class="hero-body">
                            <div class="container is-fluid">
                                <h1 class="title has-text-white has-text-centered">Logged !!</h1>
                                <h1 class="subtitle has-text-white has-text-centered">BUT IN BUILDING...</h1>
                            </div>
                        </div>
                    </section>

                    <!--<div class="field">-->
                    <!--<label class="label">Repeat your password</label>-->
                    <!--<div class="control">-->
                    <!--<input class="input " type="password" placeholder="The same password here"-->
                    <!--v-model="passwordConfirmation">-->
                    <!--</div>-->
                    <!--</div>-->

                    <!--<div class="field">-->
                    <!--<label class="label"></label>-->
                    <!--<div class="control"><input type="text" class="input"></div>-->
                    <!--</div>-->

                    <!--<div class="field">-->
                    <!--<button class="button is-danger">Set password</button>-->
                    <!--</div>-->

        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'

    export default {
        name: "Password",
        data() {
            return {
                password: '',
                passwordConfirmation: '',
                token: ''
            }
        },
        mounted() {
            // this.$store.dispatch('loadUserWithoutPass')
            // this.token = this.readCookie('access');
            this.token = this.getCookie()
            // this.$store.dispatch('loginUserGithub', this.token)
            this.$store.dispatch('loadUser')
        },
        computed: {
            // ...mapGetters([])
        },
        methods: {
            readCookie: function (name) {
                var nameEQ = name + "=";
                var ca = document.cookie.split(';');
                for (var i = 0; i < ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
                }
                return null;
            },

            getCookie: function (name) {
                let a = document.cookie.split(';')

                return a[1];
            }
        }
    }
</script>

<style scoped>

    .columns {
        min-height: 101vh;
    }

</style>