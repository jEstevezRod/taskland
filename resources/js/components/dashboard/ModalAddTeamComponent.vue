<template>
    <form action="/tasks" method="post" @submit.prevent="onSubmitTeam">
        <div class="modal-card" style="width: auto">
            <header class="modal-card-head">
                <p class="modal-card-title has-text-centered">Add Team</p>
            </header>
            <section class="modal-card-body">

                <input type="hidden" name="_token" :value="csrf">

                <label for="t_name">Your team name: </label>
                <input class="input" type="text" name="t_name" id="t_name" v-model="t_name" >

            </section>
            <footer class="modal-card-foot">
                <button class="button" type="button" @click="$parent.close()">Close</button>
                <button type="submit" class="button is-primary" @click="$parent.close()">Add Team</button>
            </footer>
        </div>
    </form>
</template>

<script>
    import { EventBus } from '../../../event-bus.js';

    export default {
        name: "ModalAddTeamComponent",
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                t_name: ''
            }
        },
        methods: {

            onSubmitTeam() {
                this.$axios.post('/teams', {
                    t_name: this.t_name,
                })
                    .then(response => {
                        this.$toast.open({
                            duration: 5000,
                            message: response.data.message,
                            position: 'is-top',
                            type: 'is-success'
                        });
                        EventBus.$emit('updateTeam', response.data.team);
                        this.$axios.post('/userInTeam', {
                            team_id: response.data.team.id
                        })
                            .then(response => console.log(response.data))
                    })
                    .catch()


            },
        }
    }
</script>

<style scoped>

</style>