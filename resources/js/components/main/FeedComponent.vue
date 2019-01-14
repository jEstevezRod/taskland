<template>

    <section class="container features">
        <feed-message-component></feed-message-component>
        <feed-message-component></feed-message-component>
        <feed-message-component></feed-message-component>
    </section>
</template>

<script>
import FeedMessageComponent from './FeedMessageComponent'
    export default {
        components: { FeedMessageComponent},
        name: "FeedComponent"
    }
</script>

<style scoped>
    .features {

        margin-bottom: 30px;

    }

</style>