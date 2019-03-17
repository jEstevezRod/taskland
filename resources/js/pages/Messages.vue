<template>
    <div class="columns is-flex is-vcentered has-background-grey-light">
        <div class="column is-12  ">
            <section class="hero is-info">
                <div class="hero-body">
                    <div class="container is-fluid">
                        <h1 class="title has-text-white has-text-centered">Messages</h1>
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Messages",
        mounted(){
            this.$store.dispatch("loadUser");
        }
    }
</script>

<style scoped>
    .columns {
        min-height: 100vh;
    }

</style>