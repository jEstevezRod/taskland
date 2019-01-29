<template>

    <section class="columns features is-center is-centered has-text-centered">
        <div class="column is-flex just-cent">

            <div class="timeline">

                <header class="timeline-header">
                    <span class="tag is-medium is-primary">Today</span>
                </header>

                <feed-message-component/>
                <feed-message-component/>
                <feed-message-component/>
                <feed-message-component/>
                <feed-message-component/>

                <header class="timeline-header">
                    <span class="tag is-primary">2017</span>
                </header>

                <div class="timeline-item">
                    <div class="timeline-marker is-icon">
                        <i class="fa fa-flag"></i>
                    </div>
                    <div class="timeline-content">
                        <p class="heading">March 2017</p>
                        <p>Timeline content - Can include any HTML element</p>
                    </div>
                </div>

                <!--<div class="timeline-header">-->
                    <!--<span class="tag is-medium is-primary">End</span>-->
                <!--</div>-->

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