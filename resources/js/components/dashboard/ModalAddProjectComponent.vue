<template>
    <form action="/tasks" method="post" @submit.prevent="onSubmitProject">
        <div class="modal-card" style="width: auto">
            <header class="modal-card-head">
                <p class="modal-card-title has-text-centered">Add Project</p>
            </header>
            <section class="modal-card-body">

                <input type="hidden" name="_token" :value="csrf">

                    <label for="p_name">Your project name: </label>
                    <input class="input" type="text" name="p_name" id="p_name" v-model="p_name" >
                <b-field label="Choose a team for you project">
                    <b-select placeholder="Select a team" v-model="p_team"  rounded>
                        <option v-for="team_option in team_list" v-bind:value="team_option.id">{{team_option.t_name}}</option>
                    </b-select>
                </b-field>


            </section>
            <footer class="modal-card-foot">
                <button class="button" type="button" @click="$parent.close()">Close</button>
                <button type="submit" class="button is-primary" @click="$parent.close()">Add Project</button>
            </footer>
        </div>
    </form>

</template>

<script>
    import { EventBus } from '../../../event-bus.js';
    export default {
        name: "ModalAddProjectComponent"
        ,
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                p_name: '',
                p_team: '',
                team_list: [],
            }
        },
        mounted(){
            this.$axios.get('/teams')
                .then(response => this.team_list = response.data.teams)
        },

        methods: {

            onSubmitProject() {
                this.$axios.post('/projects', {
                    name: this.p_name,
                    team: this.p_team,
                })
                    .then(response => {
                        this.$toast.open({
                            duration: 5000,
                            message: response.data.message,
                            position: 'is-top',
                            type: 'is-success'
                        });
                        EventBus.$emit('updateProjects', response.data.project);
                        this.$axios.post('/userInProject', {
                            project_id: response.data.project.id
                        })
                            .then( response => console.log(response.data))
                    })
                    .catch()




            },
        }

    }
</script>

<style scoped>

</style>