<template>
    <section class="container is-fluid test">
        <h1 class="title has-text-centered"> Dashboard</h1>
        <div class="columns">

            <!--left side-->
            <div class="column is-9 task-wrapper">
                <div class="container is-fluid">
                    <router-view :key="$route.path"></router-view>
                </div>
            </div>

            <!--right side-->
            <div class="column is-3 sidebar-wrapper">
                <div class="columns">
                    <div class="column is-12 sidebar">

                        <!--sidebar information-->
                        <div class="teams-wrapper">
                            <p class="subtitle">TEAMS:</p>
                            <ul>
                                <li v-for="team in teams_list">{{team.t_name}}</li>
                            </ul>
                        </div>
                        <div class="projects-wrapper">
                            <p class="subtitle">PROJECTS</p>
                            <ul>
                                <router-link v-for="project in project_list"
                                :to="{name: 'dashboard', params: {id: project.id}}">
                                    <li> {{project.p_name}}</li>
                                </router-link>
                            </ul>
                        </div>
                        <!--end sidebar information-->

                        <!--modals-->
                        <div class="box">
                            <section>
                                <button class="button is-primary is-rounded"
                                        @click="isComponentModalActive = true">
                                    Add new task
                                </button>

                                <b-modal :active.sync="isComponentModalActive" has-modal-card>
                                    <modal-add-task v-bind="formProps"></modal-add-task>
                                </b-modal>
                            </section>
                            <section>
                                <button class="button is-info is-danger is-rounded"
                                        @click="isComponentModalActive2 = true">
                                    Add new project
                                </button>

                                <b-modal :active.sync="isComponentModalActive2" has-modal-card>
                                    <modal-add-project v-bind="formProps2"></modal-add-project>
                                </b-modal>
                            </section>
                            <section>
                                <button class="button is-info is-warning is-rounded"
                                        @click="isComponentModalActive3 = true">
                                    Add new state
                                </button>

                                <b-modal :active.sync="isComponentModalActive3" has-modal-card>
                                    <modal-add-state v-bind="formProps3"></modal-add-state>
                                </b-modal>
                            </section>
                            <section>
                                <button class="button is-info  is-rounded"
                                        @click="isComponentModalActive4 = true">
                                    Add new team
                                </button>

                                <b-modal :active.sync="isComponentModalActive4" has-modal-card>
                                    <modal-add-team v-bind="formProps4"></modal-add-team>
                                </b-modal>
                            </section>
                        </div>
                        <!--end modals-->
                        <section>

                            <b-collapse class="card">
                                <div slot="trigger" slot-scope="props" class="card-header">
                                    <p class="card-header-title">
                                        Add member to my project
                                    </p>
                                    <a class="card-header-icon">
                                        <b-icon
                                                :icon="props.open ? 'menu-down' : 'menu-up'">
                                        </b-icon>
                                    </a>
                                </div>
                                <div class="card-content">
                                    <div class="content">
                                    <label for="email"> User email </label>
                                    <input type="text" class="input" id="email" v-model="emailToCheck">

                                    <b-field label="Pick a project">
                                        <b-select placeholder="Select a project" v-model="project_id_add" rounded>
                                            <option v-for="project in project_list" v-bind:value="project.id">{{project.p_name}}</option>
                                        </b-select>
                                    </b-field>
                                    </div>

                                </div>
                                <footer class="card-footer">
                                    <a class="card-footer-item" @click.prevent="addToProject">Add</a>

                                </footer>
                            </b-collapse>

                        </section>

                    </div>
                </div>
            </div>

        </div>
    </section>
</template>

<script>
    import DashboardHomeComponent from  './DashboardHomeComponent';
    import ProjectsComponent from '../components/dashboard/ProjectsComponent'

    export default {
        components:{ DashboardHomeComponent, ProjectsComponent},
        name: "TaskContainer",
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                project_id: '',
                subject: '',
                description: '',
                state: 'queue',
                tasks_list: [],
                states_list: [],
                project_list: [],
                teams_list: [],
                state_name: '',
                p_team: '',
                p_name: '',
                project_id_add: '',
                emailToCheck: '',
                isComponentModalActive: false,
                isComponentModalActive2: false,
                isComponentModalActive3: false,
                isComponentModalActive4: false,
                formProps: {
                    subject: '',
                    project_id: '',
                    description: '',
                    state: ''
                },
                formProps2: {
                    p_name: '',
                    p_team: '',
                },
                formProps3: {
                    name: '',
                    project: '',
                },
                formProps4: {
                    t_name: '',
                },
            }
        },
        mounted() {
           /*  this.$axios.get('/tasks')
                .then(response => this.tasks_list = response.data.tasks)
                .catch(error => console.log(error.response))

            this.$axios.get('/projects')
                .then(response => {
                    this.project_list = response.data.projects
                })
                .catch(error => console.log(error.response))

            this.$axios.get('/states')
                .then(response => this.states_list = response.data.states)
                .catch(error => console.log(error.response))

            this.$axios.get('/teams')
                .then(response => this.teams_list = response.data.teams)
                .catch(error => console.log(error.response))


            EventBus.$on('updateProjects', value => this.project_list.push(value))
            EventBus.$on('updateTeam', value => this.teams_list.push(value)) */
        },
        methods : {
            addToProject() {
                this.$axios.post('/userInProject', {
                    email: this.emailToCheck,
                    project_id : this.project_id_add
                }).then( response => console.log(response.data.message))
            }
        }


    }
</script>

<style scoped>

    .test {
        padding-top: 100px;
        min-height: 800px;
    }

    .sidebar-wrapper {
        border-radius: 4px;
    }

    .task-wrapper {
        border-radius: 4px;
    }

    .sidebar {
        margin: 20px;
        padding: 20px;
        border-radius: 4px;
        border: 1px solid #ebebed;
        background-color: #f0f0f2;
        box-shadow: 1px 1px 7px #9a9a9a;
        min-height: 300px;
    }

    .projects-wrapper {
        margin-top: 30px;
    }


</style>