<template>
    
    <section class="hero">
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
   .hero {
       height: 500px;
   }
</style>