<template>
    <form action="/tasks" method="post" @submit.prevent="onSubmit">
        <div class="modal-card" style="width: auto">
            <header class="modal-card-head">
                <p class="modal-card-title has-text-centered">Add task</p>
            </header>
            <section class="modal-card-body">

                <label for="subject">Your title is: </label>
                <input class="input is-rounded" type="text" name="subject" id="subject" v-model="subject" required>
                <label for="description">Your description is: </label>
                <input class="input" type="text" name="description" id="description" v-model="description" required>

                <b-field label="Pick a project">
                    <b-select placeholder="Select a project" v-model="project_id" rounded>
                        <option v-for="project in project_list" v-bind:value="project.id">{{project.p_name}}</option>
                    </b-select>
                </b-field>


                <b-field v-if="project_id != ''" label="Choose the task state">
                    <b-select placeholder="Select a character" v-model="state" rounded>
                        <option v-for="state_option in statesForProjectSelected" v-bind:value="state_option.name">
                            {{state_option.name}}
                        </option>
                    </b-select>
                </b-field>


            </section>
            <footer class="modal-card-foot">
                <button class="button" type="button" @click="$parent.close()">Close</button>
                <button type="submit" class="button is-primary" @click="$parent.close()">Add task</button>
            </footer>
        </div>
    </form>


</template>

<script>
    import {EventBus} from '../../../event-bus.js';

    export default {
        name: "ModalAddTaskComponent",
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                project_id: '',
                subject: '',
                description: '',
                state: '',
                states_list: [],
                project_list: [],
                tasks_list: [],
                p_team: '',
                p_name: '',
                isSelected: false,
                project_info: [],
                statesForProjectSelected: [],
            }
        },
        mounted() {

            this.$axios.get('/states')
                .then(response => this.states_list = response.data.states)
                .catch(error => console.log(error.response))
            this.$axios.get('/projects')
                .then(response => this.project_list = response.data.projects)
                .catch(error => console.log(error.response))

        },
        methods: {

            onSubmit() {
                this.$axios.post('/tasks', {
                    project_id: this.project_id,
                    subject: this.subject,
                    description: this.description,
                    state: this.state,
                })
                    .then(this.onSuccess)
                    .catch()
            },
            onSuccess(response) {
                this.$toast.open({
                    duration: 5000,
                    message: response.data.message,
                    position: 'is-top',
                    type: 'is-success'
                });
                EventBus.$emit('updateTasks', response.data.task);

            },
            getInfoProject() {
                console.log('dada')
                this.$axios.get('/projects/' + this.project_id)
                    .then(response => this.statesForProjectSelected = response.data.states )
            }
        },
        watch: {
            'project_id': function () {
                this.$axios.get('/projects/' + this.project_id)
                    .then(response => this.statesForProjectSelected = response.data.states )
            }
        }
    }
</script>

<style scoped>

</style>