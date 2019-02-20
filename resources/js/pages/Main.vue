<template>
    <div>
      <navigation></navigation>
      <router-view :key="$route.path"></router-view>
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
