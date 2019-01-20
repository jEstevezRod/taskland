<template>
    <div>
        <div class="columns">
            <div class="column">
                <p class="title has-text-centered">{{getProjectName}}</p>
                <div class="is-flex justify-center" v-if="getStateList.length != 0">

                    <button @click="isComponentModalActive = true"
                            class="button is-medium is-info is-inverted ">
                        <i class="fas fa-plus-circle has-text-success	"></i>
                        &nbsp Add task
                    </button>

                    <button @click="isComponentModalActive3 = true"
                            class="button is-medium is-info is-inverted ">
                        <i class="fas fa-plus-circle has-text-success	"></i>
                        &nbsp Add state
                    </button>

                    <button @click="isComponentModalActive2 = true"
                            class="button is-medium is-info is-inverted ">
                        <i class="fas fa-plus-circle has-text-success	"></i>
                        &nbsp Create project
                    </button>


                    <button @click="isComponentModalActive4 = true"
                            class="button is-medium is-info is-inverted ">
                        <i class="fas fa-plus-circle has-text-success	"></i>
                        &nbsp Create team
                    </button>
                </div>
                <div v-if="getStateList.length == 0">
                    You don't have any state. Probably you want tu add one <a @click="isComponentModalActive3 = true">clicking
                    here.</a>
                </div>

                <b-modal :active.sync="isComponentModalActive3" has-modal-card>
                    <modal-add-state :p_id="project_id"></modal-add-state>
                </b-modal>
                <b-modal :active.sync="isComponentModalActive" has-modal-card>
                    <modal-add-task :project_id="project_id"></modal-add-task>
                </b-modal>

                <b-modal :active.sync="isComponentModalActive2" has-modal-card>
                    <modal-add-project ></modal-add-project>
                </b-modal>
                <b-modal :active.sync="isComponentModalActive4" has-modal-card>
                    <modal-add-team ></modal-add-team>
                </b-modal>
            </div>
        </div>
        <div class="columns">

            <div class="my-custom column is-12" :key="$route.params.id">
                <state v-for="state in getStateList" :state="state" :project_id="project_id"></state>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex';
    import State from './StateComponent.vue'
    import ModalAddTask from './ModalAddTaskComponent'
    import ModalAddProject from './ModalAddProjectComponent'
    import ModalAddState from './ModalAddStateComponent'
    import ModalAddTeam from './ModalAddTeamComponent'

    export default {
        components: {State, ModalAddTask, ModalAddProject, ModalAddState, ModalAddTeam},
        data() {
            return {
                tasks_list: [],
                states_list: [],
                state: '',
                project_id: this.$route.params.id,
                project_name: '',
                isComponentModalActive: false,
                isComponentModalActive2: false,
                isComponentModalActive3: false,
                isComponentModalActive4: false,
            }
        },
        mounted() {
            this.project_name = this.$store.dispatch('loadProjectName', this.project_id)
        },
        created() {
            this.$store.dispatch('loadStates', this.project_id);
            this.$store.dispatch('loadTasks', this.project_id);
        },
        computed: {
            ...mapGetters([
                "getStateList", "getProjectName"
            ])
        }
    }
</script>

<style scoped>
    .my-custom {
        display: flex;
        flex-flow: row wrap;
        justify-content: center;
    }

    .justify-center {
        justify-content: space-around;
        flex-flow: row wrap;
    }

</style>