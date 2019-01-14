<template>
  <nav class="navbar is-dark" role="navigation" aria-label="main navigation">
    <div class="navbar-brand is-desktop is-vcentered">
      <router-link class="subtitle has-text-white" to="/">Taskland</router-link>
      <a
        role="button"
        class="navbar-burger"
        aria-label="menu"
        aria-expanded="false"
        @click="isOpen = !isOpen"
        v-bind:class="{'is-active': isOpen}"
      >
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
      </a>
    </div>
    <div class="navbar-menu" v-bind:class="{'is-active': isOpen}">
      <div class="navbar-end">
        <router-link to="/main" class="navbar-item is-tab">Home</router-link>
        <router-link to="/dashboard" class="navbar-item is-tab">Dashboard</router-link>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  data: function() {
    return {
      isOpen: false
    };
  }
};
</script>

<style>
</style>
