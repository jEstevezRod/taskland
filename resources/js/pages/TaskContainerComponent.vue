<template>
    <section class="container is-fluid test">
        <div class="columns">

            <!--left side-->
            <div class="column is-10 task-wrapper">
                <div class="container is-fluid">
                    <router-view :key="$route.path"></router-view>
                </div>
            </div>

            <!--right side-->
            <div class="column is-2 sidebar-wrapper">
                <div class="columns">
                    <div class="column is-12 sidebar">

                        <!--sidebar information-->
                        <div class="teams-wrapper">
                            <p class="has-text-centered has-text-grey-darker">TEAMS ({{getNumberTeams}}) </p>
                            <ul class="menu-list">
                                <a v-for="team in getTeamList">
                                    <li>
                                        <i class="fas fa-arrow-right mr-5"></i>{{team.t_name}} ( id : {{team.id}} )
                                    </li>
                                </a>
                            </ul>
                        </div>
                        <div class="projects-wrapper">
                            <p class="has-text-centered has-text-grey-darker">PROJECTS</p>
                            <ul class="menu-list">
                                <router-link v-for="project in getProjectList"
                                             :to="{name: 'dashboard', params: {id: project.id}}">
                                    <li class="has-text-grey-dark"><i class="fas fa-arrow-right mr-5"></i>
                                        {{project.p_name}}
                                    </li>
                                </router-link>
                            </ul>
                        </div>
                        <!--end sidebar information-->

                        <!--modals-->
                        <!--<div class="box">-->
                            <!--<section>-->
                                <!--<button class="button is-primary is-rounded"-->
                                        <!--@click="isComponentModalActive = true">-->
                                    <!--Add new task-->
                                <!--</button>-->

                                <!--<b-modal :active.sync="isComponentModalActive" has-modal-card>-->
                                    <!--<modal-add-task></modal-add-task>-->
                                <!--</b-modal>-->
                            <!--</section>-->
                            <!--<section>-->
                                <!--<button class="button is-info is-danger is-rounded"-->
                                        <!--@click="isComponentModalActive2 = true">-->
                                    <!--Add new project-->
                                <!--</button>-->

                                <!--<b-modal :active.sync="isComponentModalActive2" has-modal-card>-->
                                    <!--<modal-add-project></modal-add-project>-->
                                <!--</b-modal>-->
                            <!--</section>-->
                            <!--<section>-->
                                <!--<button class="button is-info is-warning is-rounded"-->
                                        <!--@click="isComponentModalActive3 = true">-->
                                    <!--Add new state-->
                                <!--</button>-->

                                <!--<b-modal :active.sync="isComponentModalActive3" has-modal-card>-->
                                    <!--<modal-add-state></modal-add-state>-->
                                <!--</b-modal>-->
                            <!--</section>-->
                            <!--<section>-->
                                <!--<button class="button is-info  is-rounded"-->
                                        <!--@click="isComponentModalActive4 = true">-->
                                    <!--Add new team-->
                                <!--</button>-->

                                <!--<b-modal :active.sync="isComponentModalActive4" has-modal-card>-->
                                    <!--<modal-add-team></modal-add-team>-->
                                <!--</b-modal>-->
                            <!--</section>-->
                        <!--</div>-->
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
                                                <option v-for="project in getProjectList" v-bind:value="project.id">
                                                    {{project.p_name}}
                                                </option>
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
    import DashboardHomeComponent from '../components/dashboard/DashboardHomeComponent';
    import ProjectsComponent from '../components/dashboard/ProjectsComponent'
    import ModalAddTask from '../components/dashboard/ModalAddTaskComponent'
    import ModalAddProject from '../components/dashboard/ModalAddProjectComponent'
    import ModalAddState from '../components/dashboard/ModalAddStateComponent'
    import ModalAddTeam from '../components/dashboard/ModalAddTeamComponent'
    import {mapGetters} from 'vuex';


    export default {
        components: {
            DashboardHomeComponent,
            ProjectsComponent,
            ModalAddTask,
            ModalAddProject,
            ModalAddState,
            ModalAddTeam
        },
        name: "TaskContainer",
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                project_id_add: '',
                emailToCheck: '',
                isComponentModalActive: false,
                isComponentModalActive2: false,
                isComponentModalActive3: false,
                isComponentModalActive4: false,
            }
        },
        created() {
            this.$store.dispatch("loadUser");
            this.$store.dispatch("loadAllTeams");
            this.$store.dispatch("loadProjects")
        },

        computed: {
            ...mapGetters([
                "getTeamList", "getNumberTeams", "getProjectList"
            ])
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

    .mr-5 {
        margin-right: 7px;
    }


</style>