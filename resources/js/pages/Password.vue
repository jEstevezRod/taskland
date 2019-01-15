<template>
    <div class="columns is-flex is-vcentered has-background-grey-light">
        <div class="column is-12  ">
            <div class="container is-fluid ">
                <div class="box">

                    <b-field class="passwordLabel"
                             label="Password"
>
                        <b-input type="password"
                                 value=""
                                 minlength="8"
                                 v-model="password"
                                 password-reveal>
                        </b-input>
                    </b-field>

                    <div class="field">
                        <label class="label">Repeat your password</label>
                        <div class="control">
                            <input class="input " type="password" placeholder="The same password here"
                                   v-model="passwordConfirmation">
                        </div>
                    </div>

                    <div class="field">
                        <label class="label"></label>
                        <div class="control"><input type="text" class="input"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Password",
        data() {
            return {
                password: '',
                passwordConfirmation: ''
            }
        }
    }
</script>

<style scoped>

    .columns {
        min-height: 101vh;
    }

</style>