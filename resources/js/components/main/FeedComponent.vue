<template>

    <section class="columns features is-center is-centered has-text-centered">
        <div class="column is-flex just-cent">

            <div class="timeline">

                <header class="timeline-header">
                    <span class="tag is-medium my-tomato has-text-white">Today</span>
                </header>

                <feed-message-component/>
                <feed-message-component/>
                <feed-message-component/>
                <feed-message-component/>
                <feed-message-component/>

                

                <div class="timeline-header">
                    <span class="tag is-medium my-tomato has-text-white">End</span>
                </div>

            </div>
        </div>
    </section>
</template>

<script>

    import FeedMessageComponent from './FeedMessageComponent'

    export default {
        components: {FeedMessageComponent},
        name: "FeedComponent"
    }
</script>

<style scoped>
    .features {

        margin-bottom: 30px;

    }
    .just-cent {
        justify-content: center;
    }

</style>