<template>
  <div class="columns">
    <div class="column is-11">
      <h1 class="title has-text-centered">Dashboard</h1>

      <div class="box is-flex custom-flex">
        <button
          @click="isComponentModalActive2 = true"
          class="button is-medium is-info is-inverted"
        >
          <i class="fas fa-plus-circle has-text-danger is-size-4"/>
          &nbsp Create project
        </button>
        
        <button
          @click="isComponentModalActive4 = true"
          class="button is-medium is-info is-inverted"
        >
          <i class="fas fa-plus-circle has-text-danger is-size-4"/>
          &nbsp Create team
        </button>
      </div>
      <b-modal :active.sync="isComponentModalActive2" has-modal-card>
        <modal-add-project></modal-add-project>
      </b-modal>
      <b-modal :active.sync="isComponentModalActive4" has-modal-card>
        <modal-add-team></modal-add-team>
      </b-modal>

      <div class="columns is-multiline">
        <div class="column is-10-mobile is-offset-1-mobile">
          <div class="box notification turquoise">
            <div class="heading">Teams</div>
            <div class="title">{{getNumberTeams}}</div>
            <div class="level">
              <div class="level-item">
                <div class>
                  <div class="heading">-</div>
                  <div class="title is-5">-</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="column is-10-mobile is-offset-1-mobile">
          <div class="box notification emerald">
            <div class="heading">Projects</div>
            <div class="title">{{ getCountProjects }}</div>
            <div class="level">
              <div class="level-item">
                <div class>
                  <div class="heading">in team</div>
                  <div class="title is-5">{{getTeamProjects}}</div>
                </div>
              </div>
              <div class="level-item">
                <div class>
                  <div class="heading">personal</div>
                  <div class="title is-5">{{getPersonalProjects}}</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="column is-10-mobile is-offset-1-mobile">
          <div class="box notification peter-river">
            <div class="heading">Tasks</div>
            <div class="title">{{getTaskNumber}}</div>
            <div class="level">
              <div class="level-item">
                <div class>
                  <div class="heading">-</div>
                  <div class="title is-5">-</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <line-chart></line-chart>
    </div>
  </div>
</template>

<script>
import LineChart from "./ChartDashboardComponent";
import { mapGetters } from "vuex";
import ModalAddProject from "./ModalAddProjectComponent";
import ModalAddTeam from "./ModalAddTeamComponent";

export default {
  components: { LineChart, ModalAddProject, ModalAddTeam },
  data() {
    return {
      isComponentModalActive2: false,
      isComponentModalActive4: false
    };
  },
  mounted() {
    this.$store.dispatch("countAllTasks");
  },

  computed: {
    ...mapGetters([
      "getTaskNumber",
      "getPersonalProjects",
      "getTeamProjects",
      "getCountProjects",
      'getNumberTeams'
    ])
  }
};
</script>

<style scoped>
.min-height {
  min-height: 500px;
}

.turquoise {
  background-color: #1abc9c;
}

.emerald {
  background-color: #2ecc71;
}

.peter-river {
  background-color: #3498db;
}

.asphalt {
  background-color: #9b59b6;
}
.custom-flex {
  justify-content: space-around;
      flex-flow: row wrap;

}
</style>