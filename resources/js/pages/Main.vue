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
  }
}
</script>

<style>
</style>
