<template>
    <div class="columns is-flex is-vcentered has-background-grey-light">
        <div class="column is-12  ">
            <div class="container is-fluid ">
                <div class="box">

                    <p>{{getuserWithoutPass}}</p>

                    <h1 class="title has-text-danger has-text-centered">BUILDING...</h1>


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
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'

    export default {
        name: "Password",
        data() {
            return {
                password: '',
                passwordConfirmation: ''
            }
        },
        mounted() {
            this.$store.dispatch('loadUserWithoutPass')
        },
        computed: mapGetters([
            'getuserWithoutPass'
        ])
    }
</script>

<style scoped>

    .columns {
        min-height: 101vh;
    }

</style>