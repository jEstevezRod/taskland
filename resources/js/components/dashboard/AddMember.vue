<template>
  <div class="columns is-flex justify-end">
    <div class="column is-6">
      <b-collapse class="card" :open="booleanCol">
        <div slot="trigger" slot-scope="props" class="card-header">
          <p class="card-header-title is-flex is-centered"><i class="fas fa-plus has-text-info"> </i> <span class="mr-1"> Add member to my team</span></p>

        </div>
        <div class="card-content">
          <div class="content">
            <label for="email">User email</label>
            <input type="text" class="input" id="email" v-model="emailToCheck">
          </div>
        </div>
        <footer class="card-footer">
          <a class="card-footer-item" @click="addToteam">Add</a>
        </footer>
      </b-collapse>
    </div>
  </div>
</template>

<script>
export default {
  props: ["team"],
  data() {
    return {
      emailToCheck: "",
      booleanCol: false
    };
  },
  methods: {
    addToteam: function() {
      this.$store.dispatch("addMember", {
        email: this.emailToCheck,
        team: this.team.id
      });
      this.emailToCheck = "";
      this.booleanCol = false
    }
  }
};
</script>

<style scoped>
.mr-1 {
    margin: 0px 5px;
}
</style>
