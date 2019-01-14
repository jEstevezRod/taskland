<template>
    <div class="hero-body">
        <div class="container has-text-centered ">
            <h1 class="title tomato">
                <span class="has-text-dark title">Taskland</span>
            </h1>
            <h2 class="subtitle dark-text"><span class="dark-text">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </span>
            </h2>
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
        color: #49affb  !important;
    }

    .subtitle {
        color: #333333 !important;

    }
    .title {
        font-family: 'Waiting for the Sunrise', cursive;
        font-size: 110px !important;
        color: #333333 !important;
    }
</style>