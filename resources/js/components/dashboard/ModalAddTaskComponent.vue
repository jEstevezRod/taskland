<template>
    <form method="post" @submit.prevent="onNewTask">
        <div class="modal-card min-heigth" style="width: auto">
            <header class="modal-card-head">
                <p class="modal-card-title has-text-centered">Add task</p>
            </header>
            <section class="modal-card-body">

                <label for="subject">Your title is: </label>
                <input class="input is-rounded" type="text" name="subject" id="subject" v-model="subject" required
                       autocomplete="off">

                <label for="description">Your description is: </label>
                <input class="input is-rounded" type="text" name="description" id="description" v-model="description"
                       required autocomplete="off">

                <label class="is-pulled-left">Due date:</label>
                <datepicker name="datepicker" id="datepicker" :format="customFormatter" @input="timemodified"></datepicker>

                <p>{{this.duedate}}</p>

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
                <button type="submit" :disabled="state == ''" class="button is-primary" @click="$parent.close()">Add
                    task
                </button>
            </footer>
        </div>
    </form>


</template>

<script>
    import {mapGetters} from 'vuex';
    import Datepicker from 'vuejs-datepicker';
    import moment from 'moment'


    export default {
        name: "ModalAddTaskComponent",
        components: {
            Datepicker
        },
        data() {
            const today = new Date();
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                project_id: '',
                subject: '',
                description: '',
                state: '',
                duedate: ''

            }
        },
        computed: {
            ...mapGetters([
                "getProjectList", "getStateList"
            ]),
        },
        mounted() {
            //add style to datepicker
            let input = this.$el.querySelector('input[name="datepicker"]');
            input.className = 'input is-rounded';
            input.style = 'z-index:9999999; width: 300px;margin-left: 15px';
        },
        methods: {

            onNewTask() {
                this.$store.dispatch('newTask', {
                    project_id: this.project_id,
                    subject: this.subject,
                    description: this.description,
                    state: this.state,
                    due_date: this.duedate,
                    progress: 0
                }).then(response => {
                    this.$toast.open({
                        duration: 5000,
                        message: response.data.message,
                        position: 'is-top',
                        type: 'is-success'
                    });
                })
            },
            customFormatter(date) {
                return moment(date).format('MMMM Do YYYY, h:mm:ss a');
            },

            timemodified(date){
                this.duedate = moment(date).format('YYYY/MM/DD')
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

    .min-heigth {
        min-height: 600px;
    }

    .input {
        margin: 10px 0;
    }


</style>