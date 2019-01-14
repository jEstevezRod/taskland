<template>
    <div class="column is-3-desktop is-4-tablet is-6-mobile task-state">
        <p class="subtitle has-text-white has-text-centered">
            {{state.name}}
        </p>
        <hr>
        <draggable class="max-height" v-model="taskToShow" :options="{group:'state'}" @start="drag=true"
                   @change="modifyState($event,state.name)">
            <task class="m-4" v-for="task in taskToShow" :task="task"></task>
        </draggable>
    </div>
</template>

<script>
    import {EventBus} from '../../../event-bus.js';
    import draggable from 'vuedraggable'

    export default {
        components: {
            draggable,
        },
        props: ['state', 'tasks_list', 'project_id'],
        name: "StateComponent",
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                taskToShow: [],
                oldState: '',
                newState: '',
            }
        },

        mounted() {

            EventBus.$on('updateTasks', value => {
                if (this.project_id == value.project_id) {
                    value.state == this.state.name ? this.taskToShow.push(value) : false
                }
            })
            for (let task of this.tasks_list) {
                if (task.state === this.state.name) {
                    this.taskToShow.push(task)
                }
            }
        },
        methods: {

            modifyState($event, state) {
                if ($event.added) {
                    console.log($event.added.element.subject, 'se ha añadido a', state)
                    this.$axios.post('/tasks/' + $event.added.element.id + '/'+ state,
                        {
                            _method: 'put',
                        }
                    ).then(response => {
                        console.log(response.data.message)
                    })
                        .catch(function (error) {
                            console.log(error.response);
                        });
                }
                if ($event.removed) {
                    console.log($event.removed.element.subject, 'se ha eliminado de', state)
                }

            }
        }

    }
</script>

<style scoped>


    .task-state {
        border: 1px solid #cbcbcb;
        border-radius: 5px;
        margin: 15px 15px;
        min-height: 100px;
        background-color: #34495e;
        box-shadow: 1px 1px 7px #d3d3d3;
    }

    .max-height {
        height: 100%;
        min-height: 50px;
    }
    .m-4 {
        margin: 12px 0;
    }

</style>