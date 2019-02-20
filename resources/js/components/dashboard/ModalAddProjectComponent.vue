<template>
    <form action="/tasks" method="post" @submit.prevent="onNewProject">
        <div class="modal-card" style="width: auto">
            <header class="modal-card-head">
                <p class="modal-card-title has-text-centered">Add Project</p>
            </header>
            <section class="modal-card-body">

                <input type="hidden" name="_token" :value="csrf">

                <label for="p_name">Your project name: </label>
                <input class="input" type="text" name="p_name" id="p_name" v-model="p_name">

                <label for="description">Description project:</label>
                <input type="text" class="input" id="description" v-model="description">
                <b-field label="Choose a team for you project">
                    <b-select placeholder="Select a team" v-model="p_team" rounded>
                        <option v-for="team_option in getTeamList" v-bind:value="team_option.id">
                            {{team_option.t_name}}
                        </option>
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
    import {mapGetters} from 'vuex'

    export default {
        name: "ModalAddProjectComponent"
        ,
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                p_name: '',
                p_team: '',
                description: ''
            }
        },
        methods: {
            onNewProject() {
                this.$store.dispatch("newProject", {
                    name: this.p_name,
                    team: this.p_team,
                    description: this.description
                }).then(response => {
                    this.$store.dispatch("addUserInProject", response.data.project)
                    this.$toast.open({
                        duration: 5000,
                        message: response.data.message,
                        position: 'is-top',
                        type: 'is-success'
                    });
                })
            },
        },
        computed: {
            ...mapGetters([
                'isLogged', 'getUser', "getTeamList"
            ])
        }

    }
</script>

<style scoped>

</style>