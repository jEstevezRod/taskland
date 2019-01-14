<template>
    <div>
      <navigation></navigation>
      <router-view></router-view>
    </div>
</template>

<script>
import Navigation from "../components/global/Navigation.vue";

export default {
  components: {
    Navigation
  },
  created() {
    this.$store.dispatch("loadUser");
  },

  /*
      Defines the computed properties on the component.
    */
  computed: {
    userData() {
      return this.$store.getters.getUser;
    }
}
}
</script>

<style>
</style>
