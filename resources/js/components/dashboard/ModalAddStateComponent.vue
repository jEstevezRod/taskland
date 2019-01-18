<template>
    <form action="/tasks" method="post" @submit.prevent="addState">
        <div class="modal-card" style="width: auto">
            <header class="modal-card-head">
                <p class="modal-card-title has-text-centered">Add new state</p>
            </header>
            <section class="modal-card-body">

                <input type="hidden" name="_token" :value="csrf">
                <label for="name">The name for the new state: </label>
                <input type="text" class="input is-info" id="name" v-model="state_name">


                <b-field label="Choose the project">
                    <b-select placeholder="Select a project" v-model="state_project" rounded>
                        <option v-for="project in project_list" v-bind:value="project.id">
                            {{project.p_name}}
                        </option>
                    </b-select>
                </b-field>

            </section>
            <footer class="modal-card-foot">
                <button class="button" type="button" @click="$parent.close()">Close</button>
                <button type="submit" class="button is-primary" @click="$parent.close()">Add State</button>
            </footer>
        </div>
    </form>

</template>

<script>
    import { EventBus } from '../../event-bus.js';

    export default {
        name: "ModalAddStateComponent",
        data (){
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                state_name: '',
                state_project: '',
                project_list: []

            }

        },
        mounted() {
            // this.$axios.get('/projects')
            //     .then(response => this.project_list = response.data.projects)
            //     .catch(error => console.log(error.response))
        },
        methods: {
            addState() {
                this.$axios.post('/states', {
                    name: this.state_name,
                    project: this.state_project
                })
                    .then(this.onSuccessState)
                    .catch(error => console.log(error.response))
            },

            onSuccessState(response) {
                EventBus.$emit('updateStates', response.data.state);
                this.$toast.open({
                    duration: 5000,
                    message: response.data.message,
                    position: 'is-top',
                    type: 'is-success'
                })

            },

        }
    }
</script>

<style scoped>

</style>