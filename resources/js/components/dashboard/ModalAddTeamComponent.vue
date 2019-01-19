<template>
    <form action="/tasks" method="post" @submit.prevent="onSubmitNewTeam">
        <div class="modal-card" style="width: auto">
            <header class="modal-card-head">
                <p class="modal-card-title has-text-centered">Add Team</p>
            </header>
            <section class="modal-card-body">

                <input type="hidden" name="_token" :value="csrf">

                <label for="t_name">Your team name: </label>
                <input class="input" type="text" name="t_name" id="t_name" v-model="t_name" autocomplete="off">

            </section>
            <footer class="modal-card-foot">
                <button class="button" type="button" @click="$parent.close()">Close</button>
                <button type="submit" class="button is-primary" @click="$parent.close()">Add Team</button>
            </footer>
        </div>
    </form>
</template>

<script>
    import {EventBus} from '../../event-bus.js';

    export default {
        name: "ModalAddTeamComponent",
        data() {
            return {
                t_name: '',
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),

            }
        },
        mounted() {
            this.user = this.$store.getters.getUser;
        },
        methods: {

            onSubmitNewTeam() {
                this.$store.dispatch('newTeam', {
                    t_name: this.t_name,
                }).then(response => {
                    console.log(response.data.message)
                    this.$store.dispatch("newTeamMember" ,
                        response.data.team_id
                    ).then( response => console.log(response.data.message))
                        .catch( error => console.error(error))
                })
                    .catch(error => console.error(error))
            },

        }
    }
</script>

<style scoped>

</style>