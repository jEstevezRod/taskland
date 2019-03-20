<template>
  <div class="conversation has-min-height-100 has-min-width-100 border">
    <h1>{{ contact ? contact.name : 'Select a contact' }}</h1>
    <messagesFeed :contact="contact" :messages="messages"/>
    <messageComposer @send="sendMessage"/>
  </div>
</template>

<script>
import MessageComposer from "./MessageComposer";
import MessagesFeed from "./MessagesFeed";

export default {
  components: { MessageComposer, MessagesFeed },
  props: {
    contact: {
      type: Object,
      default: null
    },
    messages: {
      type: Array,
      default: []
    }
  },
  data() {
    return {};
  },
  methods: {
    sendMessage: function(text) {
      console.log(text);
    }
  }
};
</script>

<style scoped>
.border {
  border: 1px solid red;
}
.conversation {
  display: flex;
  flex-flow: column;
  justify-content: space-between;
}

h1 {
  font-size: 20px;
  margin: 0;
  padding: 10px;
  border-bottom: 1px dashed lightgray;
}
</style>
