<template>
    <form action="/tasks" method="post" @submit.prevent="onAddNewState">
        <div class="modal-card" style="width: auto">
            <header class="modal-card-head">
                <p class="modal-card-title has-text-centered">Add new state</p>
            </header>
            <section class="modal-card-body">

                <input type="hidden" name="_token" :value="csrf">
                <label for="name">The name for the new state: </label>
                <input type="text" class="input is-info" id="name" v-model="state_name" autocomplete="off">


                <b-field label="Choose the project">
                    <b-select placeholder="Select a project" v-model="p_id" rounded>
                        <option v-for="project in getProjectList" v-bind:value="project.id">
                            {{project.p_name}}
                        </option>
                    </b-select>
                </b-field>

            </section>
            <footer class="modal-card-foot">
                <button class="button" type="button" @click="$parent.close()">Close</button>
                <button type="submit" class="button is-primary" @click="$parent.close()">Add State</button>
            </footer>
        </div>
    </form>

</template>

<script>
    import { mapGetters } from 'vuex';

    export default {
        name: "ModalAddStateComponent",
        props: ['p_id'],
        data (){
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                state_name: '',
            }

        },
        methods: {

            onAddNewState() {
              this.$store.dispatch('newState', {
                  name: this.state_name,
                  project: this.p_id
              }).then( response => {
                  this.$toast.open({
                      duration: 5000,
                      message: response.data.message,
                      position: 'is-top',
                      type: 'is-success'
                  });
              })
            },
        },
        computed : {
            ...mapGetters([
                'isLogged', 'getUser', "getProjectList"
            ])
        }
    }
</script>

<style scoped>

</style>