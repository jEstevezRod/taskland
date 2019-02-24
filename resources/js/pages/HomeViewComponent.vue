<template>
    <div>

        <up-side-component></up-side-component>

        <administration-component></administration-component>

        <cookie-law theme="dark-lime">
            <div slot-scope="props" class="w-100 has-text-centered">
                <span>This website uses cookies to ensure you get the best experience on our website.</span>
                <button class="skew button is-danger is-pulled-right m-5" @click="props.close">
                    <span>Ignore me</span>
                </button>
                <button class="skew button is-success is-pulled-right m-5" @click="props.accept">
                    <span>I accept</span>
                </button>
            </div>
        </cookie-law>

        <feed-component></feed-component>

    </div>
</template>

<script>
    import CookieLaw from "vue-cookie-law";
    import UpSideComponent from "../components/main/UpSideComponent.vue";
    import AdministrationComponent from "../components/main/AdministrationComponent.vue";
    import FeedComponent from "../components/main/FeedComponent.vue";
    import {mapGetters} from 'vuex'
    import router from "../routes"

    export default {
        name: "MainComponent",
        data() {
            return {
                password: "",
                password2: "",
                responsePassword: "",
                isCardModalActive: false,
                hasPass: '',
                data2: '',

            };
        },
        components: {
            CookieLaw,
            UpSideComponent,
            AdministrationComponent,
            FeedComponent
        },
        created() {
            this.$store.dispatch("loadUser");
        },
        mounted() {
            // if (Object.entries(this.getUser).length === 0) {
            //     router.push('Home')
            // }

        },
        computed: {
            ...mapGetters([
                'isLogged', 'getUser', "getToken", "getTeamList"
            ])
        },
        methods: {
            logout: function () {
                this.$store.dispatch("logoutUser")
            }
        }
    };
</script>

<style scoped>
    .w-100 {
        width: 100%;
    }

    .m-5 {
        margin: 0 5px;
    }

    .p-5 {
        padding: 15px 0;
    }

    .hidden {
        visibility: hidden
    }
</style>