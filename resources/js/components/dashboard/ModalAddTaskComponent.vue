<template>
    <form method="post" @submit.prevent="onNewTask">
        <div class="modal-card min-heigth" style="width: auto">
            <header class="modal-card-head">
                <p class="modal-card-title has-text-centered">Add task</p>
            </header>
            <section class="modal-card-body">
                <label for="subject"><strong>Your title is:</strong></label>
                <input
                        class="input is-rounded"
                        type="text"
                        name="subject"
                        id="subject"
                        v-model="subject"
                        required
                        autocomplete="off"
                >

                <label for="description"><strong>Your description is:</strong></label>
                <input
                        class="input is-rounded"
                        type="text"
                        name="description"
                        id="description"
                        v-model="description"
                        required
                        autocomplete="off"
                >
                <div class="has-margin-top-15 is-flex flex-column nowrap">
                    <label><strong>Your actual progress percentage in this task:</strong></label>
                    <input class="input is-rounded has-width-300" type="number" min="0" max="100" v-model="progress">
                </div>
                <div class="columns">
                    <div class="column is-6-mobile is-offset-3-mobile is-8-desktop is-offset-2-desktop">
                        <progress class="progress is-success has-margin-top-15" :value="progress" max="100"></progress>
                    </div>
                </div>

                <label class="is-pulled-left"><strong>Due date:</strong></label>
                <datepicker
                        name="datepicker"
                        id="datepicker"
                        :format="customFormatter"
                        @input="timeModified"
                ></datepicker>

                <!--<b-field label="Pick a project">-->
                    <!--<b-select placeholder="Select a project" v-model="project_id" rounded>-->
                        <!--<option v-for="project in getProjectList" :value="project.id">{{project.p_name}}</option>-->
                    <!--</b-select>-->
                <!--</b-field>-->

                <section class="has-margin-top-15">
                    <section>
                        <span><strong>Choose the task state:</strong></span>
                        <div class="block">
                            <b-radio
                                    v-model="state"
                                    required
                                    v-for="state_option in getStateList"
                                    :native-value="state_option.name"

                            >{{state_option.name}}
                            </b-radio>
                        </div>
                    </section>
                    <section v-if="assign_task.length !== 0" class="has-margin-top-15">
                        <b><strong>Assign the task to:</strong></b>
                        <div class="select is-multiple">
                            <select multiple :size="assign_task.length + 1" v-model="users_selected" style="width:150px">
                                <option v-for="user in assign_task" :value="user.id">{{user.name}}</option>
                            </select>
                        </div>
                        {{users_selected}}
                    </section>
                </section>
            </section>
            <footer class="modal-card-foot">
                <button class="button" type="button" @click="$parent.close()">Close</button>
                <button
                        type="submit"
                        :disabled="(state == '') || (subject == '')"
                        class="button is-primary"
                        @click="$parent.close()"
                >
                    Add
                    task
                </button>
            </footer>
        </div>
    </form>
</template>

<script>
    import {mapGetters} from "vuex";
    import Datepicker from "vuejs-datepicker";
    import moment from "moment";

    export default {
        name: "ModalAddTaskComponent",
        components: {
            Datepicker
        },
        data() {
            const today = new Date();
            return {
                csrf: document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
                project_id: this.$route.params.id,
                subject: "",
                description: "",
                state: "",
                duedate: "",
                progress: 0,
                assign_task: [],
                users_selected: [],
                team_id: 0
            };
        },
        computed: {
            ...mapGetters(["getProjectList", "getStateList"])
        },
        mounted() {
            //add style to datepicker
            let input = this.$el.querySelector('input[name="datepicker"]');
            input.className = "input is-rounded";
            input.style = "z-index:9999999; width: 300px;margin-left: 15px";
            // load information
            this.$store.dispatch("loadStates", this.project_id);
            this.$store.dispatch('loadUsersInProject', this.project_id)
                .then( task => {
                    if (task.assignable)
                    {
                        this.assign_task = task.results;
                    }
                })
            this.$store.dispatch('loadTeamWithProject', this.project_id)
                .then( team => this.team_id = team)
        },
        methods: {
            onNewTask() {
                this.$store.dispatch("newTask", {
                        project_id: this.project_id,
                        subject: this.subject,
                        description: this.description,
                        state: this.state,
                        due_date: this.duedate,
                        progress: this.progress
                    })
                    .then(response => {
                        console.log(this.users_selected.length)
                        console.log(response)
                        if (this.users_selected.length > 0)
                        {
                            this.$store.dispatch('assignTaskTo', {
                                selected : this.users_selected,
                                project_id: this.project_id,
                                task_id: response.data.task.id,
                                team_id: this.team_id
                            })
                        }
                        console.log(response)
                        this.$toast.open({
                            duration: 5000,
                            message: response.data.message,
                            position: "is-top",
                            type: "is-success"
                        });
                    });
            },
            customFormatter(date) {
                return moment(date).format("MMMM Do YYYY, h:mm:ss a");
            },

            timeModified(date) {
                this.duedate = moment(date).format("YYYY/MM/DD");
            }
        },
        watch: {
        }
    };
</script>

<style scoped>
    .min-heigth {
        min-height: 600px;
    }

    .input {
        margin: 10px 0;
    }
</style>