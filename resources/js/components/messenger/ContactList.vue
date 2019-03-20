<template>
  <div class="contact-list">
    <ul>
      <li
        v-for="(contact, index) in contacts"
        :key="contact.id"
        @click="selectContact(index, contact)"
        :class="{ 'selected' : index === selected}"
        class="contact border is-flex nowrap has-max-height-150"
      >
        <div class="avatar">
          <img :src="contact.avatar" :alt="contact.name" width="50" height="50" class="img-radius">
        </div>
        <div class="is-flex align-center justify-center flex-column has-margin-left-20">
          <div>
            <strong>{{contact.name}} {{contact.lastname}}</strong>
          </div>
          <div>
            <small>{{contact.email}}</small>
          </div>
        </div>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  props: {
    contacts: {
      type: Array,
      default: []
    }
  },
  data() {
    return {
      selected: -1
    };
  },
  methods: {
    selectContact(index, contact) {
      this.selected = index;

      this.$emit("selected", contact);
    }
  }
};
</script>

<style scoped>
.border {
  max-height: 100%;
  overflow: auto;
}
.contact {
  height: 75px;
}

.selected {
  background-color: lightblue;
}
.img-radius {
  border-radius: 50%;
}
.avatar {
  display: flex;
  align-items: center;
  margin: 0 10px;
}
.margin-3px {
  margin: 3px;
}
</style>
