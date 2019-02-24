<template>
    <div class="columns is-flex justify-end">
        <div class="column is-6 ">
            <b-collapse class="card" :open="false" :close="booleanCol">
                <div slot="trigger" slot-scope="props" class="card-header">
                    <p class="card-header-title is-flex is-centered"><i class="fas fa-plus has-text-success"> </i> <span
                            class="mr-1"> Add a new project</span></p>
                </div>
                <div class="card-content">
                    <div class="content">
                        <label for="email">Project name: </label>
                        <input type="text" class="input" id="email" v-model="projectName">
                    </div>
                </div>
                <footer class="card-footer">
                    <a class="card-footer-item" @click="onNewProject">Add</a>
                </footer>
            </b-collapse>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['team'],
        data() {
            return {
                projectName: '',
                booleanCol: false
            }
        },
        methods: {
            onNewProject() {
                this.$store.dispatch("newProject", {
                    name: this.projectName,
                    team: this.team.id,
                }).then(response => {
                    this.$store.dispatch("addTeamInProject", {
                        project_id: response.data.project.id,
                        team_id: this.team.id
                    })
                        .then( response => {
                            this.booleanCol = true;
                            this.projectName = '';
                        });

                })
            }
        }

    }
</script>

<style scoped>
    .mr-1 {
        margin: 0px 5px;
    }

</style>
