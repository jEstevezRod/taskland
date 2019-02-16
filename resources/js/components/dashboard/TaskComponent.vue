<template>
    <section>

        <div class="box" @click="isCardModalActive = true;clickTask(task)">
            <span>{{task.subject}}</span>
        </div>

        <b-modal :active.sync="isCardModalActive" :width="640" scroll="keep">
            <div class="card">

                <div class="card-content">
                    <div class="media">
                        <div class="media-content">
                            <p class="title is-4">Project: {{task.project_id}} <span v-if="task.team_id"> Team: {{task.team_id}}</span>
                            </p>
                            <p class="subtitle is-6">[ list of people whos has this task assigned]</p>
                        </div>
                    </div>

                    <div class="">
                        <p>Title: {{task.subject}}</p>
                        <p>Description: {{task.description}}</p>

                        <span class="is-fullwidth is-pulled-right">
                        <small>{{ task.created_at }}</small> <span v-if="task.dueDate">- <small class="has-text-danger">DUE DATE: {{ task.dueDate}}</small></span></span>
                        <br>

                        <hr>
                        <form  @submit.prevent="addNewComment">
                            <div class="field">
                                <label class="label">Message</label>
                                <div class="control">

                                    <textarea class="textarea" v-model="textComment"
                                              placeholder="Add a comment in this task..." required autocomplete="off"></textarea>
                                </div>
                            </div>
                            <div class="is-field">
                                <div class="control has-text-right">
                                    <button type="submit" class="button is-info">Submit</button>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <div class="taskContainer columns">
                            <div class="column">
                        <comment v-for="com in comments" :comment="com"></comment>
                            </div>
                    </div>
                    </div>
                </div>
            </div>
        </b-modal>
    </section>
</template>

<script>
    import Comment from './Comment.vue'
    import { mapGetters } from 'vuex';


    export default {
        name: "TaskComponent",
        components: {
            Comment
        },
        props: ['task'],
        data() {
            return {
                isCardModalActive: false,
                textComment: '',
            }
        },
        methods: {
            clickTask: function (task) {
                this.$store.dispatch('loadCommentsTask', task.id)
            },
            addNewComment: function () {
                this.$store.dispatch('newComment', {
                    text: this.textComment,
                    author_id: this.getUserID,
                    task_id: this.task.id
                } )
                    .then( response => {
                        this.textComment = '';
                        this.$toast.open({
                            duration: 3000,
                            message: response.data.message,
                            position: 'is-top',
                            type: 'is-success'
                        });
                    })
            }
        },
        computed: {

        ...mapGetters([
                "getUserID", "comments"
            ])
        }

    }
</script>

<style scoped>
    .taskContainer {
        position: relative;
        overflow: auto;
        max-height: 375px;
    }

    .card {
        border-radius: 7px;
    }
</style>