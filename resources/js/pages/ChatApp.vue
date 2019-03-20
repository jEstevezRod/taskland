<template>
<div class="chat-app columns is-flex wrap has-margin-top-40 has-margin-bottom-40">
    <conversation :contact="selectedContact" :messages="messages" class="column is-7 is-offset-1  is-10-mobile is-offset-mobile-1 is-offset-1-mobile border "></conversation>
    <contactList :contacts="contacts" @selected="startConversationWith" class="column is-3 is-10-mobile is-offset-1-mobile border"></contactList>
</div>
</template>

<script>

    import Conversation from '../components/messenger/Conversation.vue';
    import ContactList from '../components/messenger/ContactList.vue'

export default {

    components: { Conversation, ContactList},
    data(){
        return {
            selectedContact: null,
            messages: [],
            contacts: []
        }
    },
    mounted() {
        axios.get('http://localhost:8000/api/auth/contacts')
        .then( response => {
            console.dir(response.data)
            this.contacts = response.data
        })
    },
    methods: {
        startConversationWith(contact){
            axios.get(`http://localhost:8000/api/auth/messages/${contact.id}`)
            .then( response => {
                console.dir(response);
                this.messages = response.data
                this.selectedContact = contact;
            })

        }
    }

}
</script>

<style scoped>
    .border {
        border: 1px solid rgb(202, 202, 202);
        height: 80vh;
        padding: 0;
    }

</style>
