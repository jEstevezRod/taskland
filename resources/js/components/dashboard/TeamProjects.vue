<template>
  
    <div>
        <router-link :to="{name: 'project', params: {id: project.id}}">
      <div class="my-box">
        <p class="subtitle"></p>
        {{project.p_name}}
      </div>
      </router-link>
    </div>
  
</template>

<script>
export default {
  props: ["project"]
};
</script>

<style scoped>
.my-box {
  padding: 15px;
  border: 1px solid #d3d3d3;
  border-radius: 7px;
  text-align: center;
}
</style>
