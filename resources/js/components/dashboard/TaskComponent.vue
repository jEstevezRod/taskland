<template>
    <section>

        <div class="box" @click="isCardModalActive = true">
            <span>{{task.subject}}</span>
        </div>

        <b-modal :active.sync="isCardModalActive" :width="640" scroll="keep">
            <div class="card">

                <div class="card-content">
                    <div class="media">
                        <div class="media-content">
                            <p class="title is-4">[ project name] - [ team name ?]</p>
                            <p class="subtitle is-6">[ list of people whos has this task assigned]</p>
                        </div>
                    </div>

                    <div class="">
                        <p>[subject]</p>
                        <p>[ description ]</p>

                        <span class="is-fullwidth is-pulled-right">
                        <small>[ created date ]</small> - <small> [ due date ]</small></span>
                        <br>
                        <hr>
                        <div class="field">
                            <label class="label">Message</label>
                            <div class="control">
                                <textarea class="textarea" placeholder="Add a comment in this task..."></textarea>
                            </div>
                        </div>
                        <div class="is-field">
                            <div class="control has-text-right">
                                <button class="button is-info">Submit</button>
                            </div>
                        </div>
                        <hr>
                        <div class="box is-fullwidth special-box">
                            <p>[ comment ]</p>
                            <span class="is-flex-end"> <small class="has-text-grey">[ created by ] at [ date ]</small> </span>
                        </div>
                        <div class="box is-fullwidth special-box">
                            <p>[ comment ]</p>
                            <span class="is-flex-end"> <small class="has-text-grey">[ created by ] at [ date ]</small> </span>
                        </div>
                        <div class="box is-fullwidth special-box">
                            <p>[ comment ]</p>
                            <span class="is-flex-end"> <small class="has-text-grey">[ created by ] at [ date ]</small> </span>
                        </div>


                    </div>
                </div>
            </div>
        </b-modal>
    </section>
</template>

<script>
    export default {
        name: "TaskComponent",
        props: ['task'],
        data() {
            return {
                isCardModalActive: false
            }
        },
        methods: {}
    }
</script>

<style scoped>
    .is-flex-end {
        display: flex;
        justify-content: flex-end;
    }

    .special-box {
        padding: 13px 8px 8px 12px;
    }
    .card{
        border-radius: 7px;
    }
</style>