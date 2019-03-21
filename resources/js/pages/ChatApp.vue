<template>
  <div class="chat-app columns is-flex wrap has-margin-top-40 has-margin-bottom-40">
    <conversation
      :contact="selectedContact"
      :messages="messages"
      class="column is-7 is-offset-1 is-10-mobile is-offset-mobile-1 is-offset-1-mobile border"
      @updateMessages="updateNewMessage"
    ></conversation>
    <contactList
      :contacts="contacts"
      @selected="startConversationWith"
      class="column is-3 is-10-mobile is-offset-1-mobile border"
    ></contactList>
  </div>
</template>

<script>
import Conversation from "../components/messenger/Conversation.vue";
import ContactList from "../components/messenger/ContactList.vue";
import { mapGetters } from "vuex";
export default {
  components: { Conversation, ContactList },
  data() {
    return {
      selectedContact: null,
      messages: [],
      contacts: [],
      user: {}
    };
  },
  created() {
    this.$store.dispatch("loadUser").then(response => {
      this.user = response;
    });
  },
  mounted() {
    let self= this
    setTimeout(()=>{
        console.log(`---------------------------messages.${this.getUser.id}--------------------------`);
        Echo.private(`messages.${this.getUser.id}`).listen("NewMessage", function(e) {
            self.handleIncoming(e.message);
    });
    },1000)
    

    axios.get("http://localhost:8000/api/auth/contacts").then(response => {
      console.dir(response.data);
      this.contacts = response.data;
    });
  },
  methods: {
    startConversationWith(contact) {
      axios
        .get(`http://localhost:8000/api/auth/messages/${contact.id}`)
        .then(response => {
          console.dir(response);
          this.messages = response.data;
          this.selectedContact = contact;
        });
    },

    updateNewMessage(message) {
      this.messages.push(message);
    },

    handleIncoming(message) {
      if (this.selectedContact && message.from == this.selectedContact.id) {
        this.updateNewMessage(message);
        return;
      }
    }
  },
  computed: {
    ...mapGetters(["getUser"])
  }
};
</script>

<style scoped>
.border {
  border: 1px solid rgb(202, 202, 202);
  height: 80vh;
  padding: 0;
}
</style>
