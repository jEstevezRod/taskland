<template>
    <nav class="navbar is-dark" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <router-link class="navbar-item has-text-white" to="/">Taskland</router-link>
            <a
                    role="button"
                    class="navbar-burger"
                    aria-label="menu"
                    aria-expanded="false"
                    @click="isOpen = !isOpen"
                    v-bind:class="{'is-active': isOpen}"
            >
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>
        <div class="navbar-menu" v-bind:class="{'is-active': isOpen}">
            <div class="navbar-end">
                <router-link to="/main" class="navbar-item is-tab">Home</router-link>
                <router-link to="/dashboard" class="navbar-item is-tab">Dashboard</router-link>
                <router-link to="/calendar" class="navbar-item is-tab">Calendar</router-link>
                <router-link to="/notes" class="navbar-item is-tab">Notes</router-link>
                <router-link to="/inbox" class="navbar-item is-tab">Messages</router-link>
                <div class="navbar-item has-dropdown is-hoverable has-margin-right">
                    <a class="navbar-link">
                        {{getUser.name}}
                    </a>

                    <div class="navbar-dropdown">
                        <a class="navbar-item">
                            Profile
                        </a>
                        <a class="navbar-item">
                            Settings
                        </a>

                        <hr class="navbar-divider">
                        <a class="navbar-item" @click="logout">
                            Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
    import {mapGetters} from 'vuex'

    export default {
        data: function () {
            return {
                isOpen: false
            };
        },
        mounted() {
        },
        computed: mapGetters([
            'getUser', 'isLogged'
        ]),
        methods: {
            logout: function() {
                this.$store.dispatch("logoutUser")
            }
        }
    }
    ;
</script>

<style scoped>

    @media screen and (min-width: 1088px) {

        .navbar-dropdown {
            left: inherit;
            right: 0 !important;
        }
    }
</style>
