<template>
    <div class="columns is-flex is-vcentered has-background-grey-light">
        <div class="column is-12  ">
            <section class="hero is-info">
                <div class="hero-body">
                    <div class="container is-fluid">
                        <h1 class="title has-text-white has-text-centered">Notes</h1>
                        <b-field label="Select a date">
                            <b-datepicker
                                    placeholder="Click to select..."
                                    icon="calendar-today">
                            </b-datepicker>
                        </b-field>
                    </div>
                </div>
            </section>

        </div>
    </div>
</template>

<script>
    export default {
        name: "Notes"
    }
</script>

<style scoped>
    .columns {
        min-height: 100vh;
    }

</style>