<template>
    <div>
        <div class="columns">
            <div class="column">
                <button class="button" @click="goBack">
                <span class="icon is-small">
              <i class="fas fa-arrow-left is-size-5"></i>
                </span>
                    <span>Back</span>
                </button>
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

                </div>
                <div class="box m-5">
                    <p v-if="users.length !== 0"><strong>Participants :</strong><span v-for="(user, index) in users"> <span
                            class="is-capitalized"> {{user.name}} </span><span
                            class="is-capitalized">{{user.lastname}} </span>{{ index == (users.length - 1) ? '' : ', '}}</span>
                    </p>

                    <p v-if="loadProject.description"><strong>Description : </strong>{{loadProject.description}}</p>
                </div>
                <hr>
                <div class="is-pulled-right" v-if="getStateList.length != 0">
                    <b-field>
                        <b-radio-button v-model="radioButton"
                                        native-value="board"
                                        type="is-info">
                            <i class="fas fa-th-large"></i>
                            <span class="has-margin-left-5"> Boards</span>
                        </b-radio-button>

                        <b-radio-button v-model="radioButton"
                                        native-value="list"
                                        type="is-success">
                            <i class="fas fa-list-ul"></i>
                            <span class="has-margin-left-5"> List</span>
                        </b-radio-button>
                    </b-field>
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


            </div>
        </div>
        <div class="columns">

            <div v-if="radioButton === 'board'" class="my-custom column is-12" :key="$route.params.id">
                <state v-for="state in getStateList" :state="state" :project_id="project_id"></state>
            </div>

            <div v-if="radioButton === 'list'" :key="$route.params.id" class="column is-12">

                <state-list v-for="state in getStateList" :state="state" :project_id="project_id"></state-list>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex';
    import State from './StateComponent.vue'
    import StateList from './StatesList.vue'
    import ModalAddTask from './ModalAddTaskComponent'
    import ModalAddState from './ModalAddStateComponent'


    export default {
        components: {State, ModalAddTask, ModalAddState,StateList},
        data() {
            return {
                tasks_list: [],
                states_list: [],
                state: '',
                project_id: this.$route.params.id,
                project_name: '',
                isComponentModalActive: false,
                isComponentModalActive3: false,
                users: [],
                radioButton: 'board'
            }
        },
        mounted() {
            this.project_name = this.$store.dispatch('loadProjectName', this.project_id)
        },
        created() {
            this.$store.dispatch('loadStates', this.project_id);
            this.$store.dispatch('loadTasks', this.project_id);
            this.$store.dispatch('loadTeamMembersWithProject', this.project_id)
                .then(response => this.users = response)
        },
        computed: {
            ...mapGetters([
                "getStateList", "getProjectName", 'loadProject'
            ])
        },
        methods: {

            goBack: function () {
                this.$router.push("/dashboard");
            }
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

    .m-5 {
        margin: 10px 0;
    }

</style>