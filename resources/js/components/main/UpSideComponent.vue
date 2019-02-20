<template>
    
    <section class="hero is-large is-bold header-image">
        <hero-component></hero-component>
    </section>
</template>

<script>
import HeroComponent from './HeroComponent'
    export default {
        components: { HeroComponent},
        name: "UpSideComponent"
    }
</script>

<style scoped>
    .header-image {
        background-image: url("../../../../public/images/bg2.png");
        /* background-color: #1dd1a1; */
        background-position: center center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        /* background-color: #999; */
    }

</style>