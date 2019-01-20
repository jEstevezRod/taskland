<template>
    <form method="post" @submit.prevent="onNewTask">
        <div class="modal-card" style="width: auto">
            <header class="modal-card-head">
                <p class="modal-card-title has-text-centered">Add task</p>
            </header>
            <section class="modal-card-body">

                <label for="subject">Your title is: </label>
                <input class="input is-rounded" type="text" name="subject" id="subject" v-model="subject" required autocomplete="off">
                <label for="description">Your description is: </label>
                <input class="input is-rounded" type="text" name="description" id="description" v-model="description" required autocomplete="off">


                <b-field label="Pick a project">
                    <b-select placeholder="Select a project" v-model="project_id" rounded>
                        <option v-for="project in getProjectList" v-bind:value="project.id">{{project.p_name}}</option>
                    </b-select>
                </b-field>


                <b-field v-if="project_id != ''" label="Choose the task state" rounded>
                    <!--<b-select placeholder="Select a character" v-model="state" rounded>-->
                        <!--<option v-for="state_option in getStateList" v-bind:value="state_option.name">-->
                            <!--{{state_option.name}}-->
                        <!--</option>-->
                    <!--</b-select>-->
                    <section>
                        <div class="block">
                            <b-radio v-model="state"
                                     required
                                     v-for="state_option in getStateList"
                                     :native-value="state_option.name">
                                {{state_option.name}}
                            </b-radio>
                        </div>
                        <p class="content">
                            <b>Selection:</b>
                            {{ state }}
                        </p>
                    </section>
                </b-field>


            </section>
            <footer class="modal-card-foot">
                <button class="button" type="button" @click="$parent.close()">Close</button>
                <button type="submit" :disabled="state == ''" class="button is-primary" @click="$parent.close()">Add task</button>
            </footer>
        </div>
    </form>


</template>

<script>
    import { mapGetters} from 'vuex';


    export default {
        name: "ModalAddTaskComponent",
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                project_id: '',
                subject: '',
                description: '',
                state: '',
            }
        },
        computed: {
            ...mapGetters([
                "getProjectList", "getStateList"
            ])
        },
        methods: {

            onNewTask() {
                this.$store.dispatch('newTask', {
                    project_id: this.project_id,
                    subject: this.subject,
                    description: this.description,
                    state: this.state,
                }).then( response => {
                    this.$toast.open({
                        duration: 5000,
                        message: response.data.message,
                        position: 'is-top',
                        type: 'is-success'
                    });
                })
            }

        }
        ,
        watch: {
            'project_id': function () {
                this.$store.dispatch('loadStates', this.project_id)
            }
        }
    }
</script>

<style scoped>

</style>