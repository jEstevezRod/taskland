<template>
  <div class="columns test">
    <!--left side-->
    <div
      class="column is-10-mobile is-offset-1-mobile  is-7-tablet is-offset-1-tablet is-8-desktop task-wrapper"
    >
      <router-view :key="$route.path"></router-view>
    </div>
    <!--right side-->
    <div
      class="column is-8-mobile is-offset-2-mobile is-3-tablet sidebar-wrapper is-2-desktop sidebar projects-wrapper"
    >
      <!--  <div class="columns">
                    <div class="column is-10-mobile is-offset-1-mobile is-10-tablet is-offset-1-tablet sidebar">
      -->
      <!--sidebar information-->
      <div class="teams-wrapper">
        <p class="has-text-centered has-text-grey-darker"> <strong>TEAMS ({{getNumberTeams}})</strong> </p>
        <ul class="menu-list has-margin-top-10">
          <router-link v-for="team in getTeamList" :to="{name: 'team', params: {id:team.id}}">
            <li>
              <i class="fas fa-arrow-right mr-5"></i>
              {{team.t_name}} ( id : {{team.id}} )
            </li>
          </router-link>
        </ul>
      </div>
      <div class="projects-wrapper">
        <p class="has-text-centered has-text-grey-darker"><strong>PROJECTS ({{getProjectList.length}})</strong> </p>
        <ul class="menu-list has-margin-top-10">
          <router-link
            v-for="project in getProjectList"
            :to="{name: 'project', params: {id: project.id}}"
          >
            <li class="has-text-grey-dark break-word">
              <i class="fas fa-arrow-right mr-5"></i>
              {{project.p_name}}
            </li>
          </router-link>
        </ul>
      </div>
    </div>
  </div>
  <!-- </div>
  </div>-->
</template>

<script>
import DashboardHomeComponent from "../components/dashboard/DashboardHomeComponent";
import ProjectsComponent from "../components/dashboard/ProjectsComponent";
import ModalAddTask from "../components/dashboard/ModalAddTaskComponent";
import ModalAddProject from "../components/dashboard/ModalAddProjectComponent";
import ModalAddState from "../components/dashboard/ModalAddStateComponent";
import ModalAddTeam from "../components/dashboard/ModalAddTeamComponent";
import { mapGetters } from "vuex";

export default {
  components: {
    DashboardHomeComponent,
    ProjectsComponent,
    ModalAddTask,
    ModalAddProject,
    ModalAddState,
    ModalAddTeam
  },
  name: "TaskContainer",
  data() {
    return {
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
      team_id_add: "",
      emailToCheck: "",
      isComponentModalActive: false,
      isComponentModalActive2: false,
      isComponentModalActive3: false,
      isComponentModalActive4: false
    };
  },
  created() {
    this.$store.dispatch("loadUser");
    this.$store.dispatch("loadAllTeams");
    this.$store.dispatch("loadProjects");
  },

  computed: {
    ...mapGetters(["getTeamList", "getNumberTeams", "getProjectList"])
  },

  methods: {
    addToteam: function() {
      this.$store.dispatch("addMember", {
        email: this.emailToCheck,
        team: this.team_id_add
      });
    }
  }
};
</script>

<style scoped>
.test {
  padding-top: 30px;
  min-height: 800px;
}

.sidebar-wrapper {
  border-radius: 4px;
}

.task-wrapper {
  border-radius: 4px;
}

.sidebar {
  padding: 20px;
  border-radius: 4px;
  border: 1px solid #ebebed;
  background-color: #f0f0f2;
  box-shadow: 1px 1px 7px #9a9a9a;
}

.projects-wrapper {
  margin-top: 30px;
  margin-bottom: 40px;
}

.mr-5 {
  margin-right: 7px;
}

.break-word {
  word-break: break-all;
}
</style>