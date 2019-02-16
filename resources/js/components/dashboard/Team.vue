<template>

  <div class="columns">
    <div class="column is-10 is-offset-1">
      <p class="title has-text-centered">Team {{team.t_name}}</p>
      <small class="is-pulled-right ">Created at : {{team.created_at}}</small>
      <br>
      <p class="subtitle">Users in this team:</p>
      <hr>
      <div class="columns">
        <team-user v-for="member in listMembers" :member="member"></team-user>
      </div>
      <add-member class="" :team="team"></add-member>
      <p class="subtitle">Projects:</p>
      <hr>
      <div class="columns is-flex wrap">
        <team-projects
         class="column is-8-mobile is-offset-2-mobile is-4-tablet is-3-desktop " 
         v-for="p in getprojectListbyTeam" 
         :project="p"
         ></team-projects>
      </div>
      <add-project :team="team"></add-project>
    </div>
  </div>

</template>

<script>
import { mapGetters } from "vuex";
import TeamUser from "./TeamUser.vue";
import TeamProjects from "./TeamProjects.vue";
import AddMember from "./AddMember.vue";
import AddProject from "./AddProject.vue";

export default {
  components: { TeamUser, TeamProjects, AddMember, AddProject },
  data() {
    return {
      team_id: this.$route.params.id,
      emailToCheck: ""
    };
  },
  created() {
    this.$store.dispatch("loadTeam", this.team_id);
    this.$store.dispatch("loadTeamMembers", this.team_id);
    this.$store.dispatch("loadProjectsbyTeam", this.team_id);
  },
  computed: {
    ...mapGetters(["team", "listMembers", "getprojectListbyTeam"])
  },
  methods: {}
};
</script>

<style scoped>
</style>
