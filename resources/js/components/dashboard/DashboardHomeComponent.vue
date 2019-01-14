<template>
    <div class="container is-fluid">
        <div class="columns is-multiline ">

            <div class="column is-10-mobile is-offset-1-mobile">
                <div class="box notification turquoise">
                    <div class="heading">Teams</div>
                    <div class="title">3</div>
                    <div class="level">
                        <div class="level-item">
                            <div class="">
                                <div class="heading">-</div>
                                <div class="title is-5">-</div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="column is-10-mobile is-offset-1-mobile">
                <div class="box notification emerald ">
                    <div class="heading">Projects</div>
                    <div class="title">10</div>
                    <div class="level">
                        <div class="level-item">
                            <div class="">
                                <div class="heading">in team</div>
                                <div class="title is-5">3</div>
                            </div>
                        </div>
                        <div class="level-item">
                            <div class="">
                                <div class="heading">personal</div>
                                <div class="title is-5">7</div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="column is-10-mobile is-offset-1-mobile">
                <div class="box notification peter-river">
                    <div class="heading">Tasks</div>
                    <div class="title">78</div>
                    <div class="level">
                        <div class="level-item">
                            <div class="">
                                <div class="heading">-</div>
                                <div class="title is-5">-</div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

        <div class="columns">
            <div class="column  min-height">
                <line-chart></line-chart>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "DashboardHomeComponent"
    }
</script>

<style scoped>
    .min-height {
        min-height: 500px;
    }

    .turquoise {
        background-color: #1abc9c;
    }
    .emerald {
        background-color: #2ecc71;
    }
    .peter-river {
        background-color: #3498db;
    }
    .asphalt {
        background-color: #9b59b6;
    }

</style>