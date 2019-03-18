<template>
    <div class="columns">
        <div class="column is-10 is-offset-1 is-8-mobile is-offset-2-mobile max-height has-margin-top-40">
            <p class="title">Profile</p>
            <div class="is-flex my-flex"> <button class="button is-info has-text-white"><i class="fas fa-edit edit has-margin-right-10"></i> Edit</button></div>
            <hr>
            <div class="columns">
                <div class="column is-6">
                    <p class="has-margin-top-15 has-margin-bottom-15"><strong>Name:</strong> {{getUser.name}}</p>
                    <p class="has-margin-top-15 has-margin-bottom-15"><strong>Surname:</strong> {{getUser.lastname}}</p>
                    <p class="has-margin-top-15 has-margin-bottom-15"><strong>Logo:</strong> </p>
                        <img :src="getUser.avatar" alt="" width="200px" height="150px">
                    <div v-if="getUser.avatar === null"><fileUpload></fileUpload></div>
                </div>
                  <div class="is-divider-vertical"></div>
                <div class="column is-6">
                    <p class="has-margin-top-15 has-margin-bottom-15"><strong>Email: </strong> {{getUser.email}}</p>
                    <p class="has-margin-top-15 has-margin-bottom-15"><strong>Created at:</strong> {{getUser.created_at}}</p>
                    <p class="has-margin-top-15 has-margin-bottom-15"><strong>Alias: </strong> {{getUser.alias}}</p>
                </div>
            </div>
           
            

        
        </div>
    </div>
</template>

<script>
import {mapGetters} from 'vuex'
import FileUpload from '../components/profile/FileUpload'
export default {
    components: {FileUpload},
    data(){
        return {

        }
    },
    mounted() {
        this.$store.dispatch("loadUser");
    },
    computed :{
        ...mapGetters([
            'getUser'
        ])
    }
}
</script>

<style scoped>
    

.max-height {
    height: 96vh;
}

.my-flex {
    justify-content: flex-end
}

.edit {
    font-size: 15px;
    }

</style>
