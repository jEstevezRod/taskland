<template>
    <div class="my-custom" :key="$route.params.id">
        <state :project_id="project_id" :tasks_list="tasks_list" v-for="state in states_list" :state="state"></state>
    </div>
</template>

<script>
    import {EventBus} from '../../event-bus';

    export default {
        name: "ProjectsComponent",
        data() {
            return {
                tasks_list: [],
                states_list: [],
                state: '',
                project_id: this.$route.params.id
            }
        },
        created() {
            EventBus.$on('updateStates', value => {
                if (this.project_id == value.project) {
                    this.states_list.push(value)
                }
            })
            EventBus.$on('updateTasks', value => {
                if (this.project_id == value.project_id) {
                    this.tasks_list.push(value)
                }
            })

            this.$axios.get('/projects/' + this.$route.params.id)
                .then(response => {
                    if (this.project_id == response.data.project_id) {
                        this.tasks_list = response.data.tasks
                        this.states_list = response.data.states
                    }
                })

        },


    }
</script>

<style scoped>
    .my-custom {
        display: flex;
        flex-flow: row wrap;
        justify-content: center;
    }

</style>