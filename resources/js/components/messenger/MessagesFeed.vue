<template>
  <div class="feed" ref="feed">
    <ul v-if="contact">
      <li
        v-for="message in messages"
        :class="`messagee${message.to == contact.id ? ' sent' : ' received'}`"
        :key="message.id"
      >
        <div class="text">{{ message.text }}</div>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  props: {
    contact: {
      type: Object
    },
    messages: {
      type: Array,
      required: true
    }
  }
};
</script>

<style scoped>
.feed {
  height: 99%;
    max-height: 628px;
  overflow-y: scroll;
  overflow-x: hidden;
}
.messagee {
  margin: 0;
}
.sent {
  text-align: right;
}
.received {
  text-align: left;
}
.text {
  max-width: 400px;
  border-radius: 5px;
  padding: 12px;
  display: inline-block;
}

ul {
  list-style-type: none;
  padding: 5px;
}

li.messagee {
  margin: 10px 0;
  width: 100%;
}

li.messagee.received > .text {
  background: #e0df8c;
}
li.messagee.sent > .text {
  background: #81c4f9;
}

@media (max-width: 480px) {
  .feed {
        max-height: 470px !important;
  }
}
</style>
