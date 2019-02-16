<template>
    <div class="hero-body">
        <div class="container has-text-centered ">
            <p class="title2 tomato">
                Taskland
            </p>
        </div>
    </div>
</template>

<script>
    export default {
        name: "HeroComponent"
    }
</script>

<style scoped>
    .hero-body .container {
        max-width: 700px;
    }

    .hero-body .subtitle {
        color: hsl(192,17%,99%) !important;
        padding-top: 2rem;
        line-height: 1.5;
    }
    .dark-text {
        color: #333333 !important;
    }

    .tomato {
        color: rgb(252, 72, 72)  !important;
    }

    .subtitle {
        color: #333333 !important;

    }
    .title2 {
        font-family: 'Waiting for the Sunrise', cursive;
        font-size: 110px !important;
        font-weight: 600;
        
    }
</style>