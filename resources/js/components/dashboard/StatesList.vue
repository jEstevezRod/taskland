<template>
    <div class="column is-10-mobile is-offset-1-mobile">
        <div class="is-flex jus-stretch">
            <p class="my-center"><strong>{{state.name}}</strong></p>
        </div>
        <hr>
        <div class="m-4" v-for="task in tasks" :task="task">

                    <div class="has-margin-top-5 has-margin-bottom-5" @click="isCardModalActive = true;clickTask(task)">
                        <span><i class="far fa-circle has-margin-right-5 is-size-7"></i><span ><router-link class="font-color" :to="{name: 'task', params: {id: task.id}}">{{task.subject}}</router-link></span> </span>
                    </div>

        </div>
    </div>
</template>

<script>
    import {mapGetters} from "vuex";
    import draggable from "vuedraggable";
    import Task from "./TaskComponent";

    export default {
        components: {
            draggable,
            Task
        },
        props: ["state", "project_id"],
        name: "StateComponent",
        data() {
            return {
                csrf: document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
                oldState: "",
                newState: ""
            };
        },
        computed: {
            ...mapGetters(["isLogged", "getUser"]),
            tasks: function () {
                return this.$store.getters.getTasks.filter(
                    i => i.state === this.state.name
                );
            }
        },
        methods: {
            modifyState($event, state) {
                if ($event.added) {
                    console.log($event.added.element.subject, "se ha añadido a", state);

                    this.$store
                        .dispatch("changeState", {
                            id: $event.added.element.id,
                            state: state
                        })
                        .then(response => {
                            this.$store.commit("modifyTasks", {
                                id: $event.added.element.id,
                                state
                            });
                            this.$toast.open({
                                duration: 3000,
                                message: response.data.message,
                                position: "is-top",
                                type: "is-success"
                            });
                        });
                }
                if ($event.removed) {
                    console.log(
                        $event.removed.element.subject,
                        "se ha eliminado de",
                        state
                    );
                }
            },
            clickTask: function(task) {
                this.$store.dispatch("loadCommentsTask", task.id);
            },

            deleteState() {
                this.$dialog.confirm({
                    message:
                        "If you delete a state with tasks inside you will delete all of them, take care !",
                    onConfirm: () =>
                        this.$store.dispatch("deleteState", this.state).then(response =>
                            this.$toast.open({
                                duration: 3000,
                                message: response.message,
                                position: "is-top",
                                type: "is-success"
                            })
                        )
                });
                //
            }
        }
    };
</script>

<style scoped>
    .font-color{
        color: hsl(204, 86%, 53%) !important;
    }
</style>