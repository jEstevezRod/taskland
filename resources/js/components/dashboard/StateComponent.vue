<template>
  <div class="column is-3-desktop is-3-tablet is-6-mobile task-state">
    <div class="is-flex jus-stretch">
      <p class="my-center has-text-white">{{state.name}}</p>
      <i
        @click="deleteState()"
        class="fas fa-times-circle has-text-danger is-size-4"
        style="cursor:pointer;"
      ></i>
    </div>
    <hr>
    <draggable
      class="max-height"
      :value.sync="tasks"
      :options="{group:'state'}"
      @start="drag=true"
      @change="modifyState($event,state.name)"
    >
        <task class="m-4" v-for="task in tasks" :task="task"></task>
    </draggable>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import draggable from "vuedraggable";
import Task from "./TaskComponent";

export default {
  components: {
    draggable,
    Task
  },
  props: ["state", "project_id"],
  name: "StateComponent",
  data() {
    return {
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
      oldState: "",
      newState: ""
    };
  },
  computed: {
    ...mapGetters(["isLogged", "getUser"]),
    tasks: function() {
      return this.$store.getters.getTasks.filter(
        i => i.state === this.state.name
      );
    }
  },
  methods: {
    modifyState($event, state) {
      if ($event.added) {
        console.log($event.added.element.subject, "se ha añadido a", state);

        this.$store
          .dispatch("changeState", {
            id: $event.added.element.id,
            state: state
          })
          .then(response => {
            this.$store.commit("modifyTasks", {
              id: $event.added.element.id,
              state
            });
            this.$toast.open({
              duration: 3000,
              message: response.data.message,
              position: "is-top",
              type: "is-success"
            });
          });
      }
      if ($event.removed) {
        console.log(
          $event.removed.element.subject,
          "se ha eliminado de",
          state
        );
      }
    },

    deleteState() {
      this.$dialog.confirm({
        message:
          "If you delete a state with tasks inside you will delete all of them, take care !",
        onConfirm: () =>
          this.$store.dispatch("deleteState", this.state).then(response =>
            this.$toast.open({
              duration: 3000,
              message: response.message,
              position: "is-top",
              type: "is-success"
            })
          )
      });
      //
    }
  }
};
</script>

<style scoped>
.task-state {
  border: 1px solid #cbcbcb;
  border-radius: 5px;
  margin: 15px 15px;
  min-height: 100px;
  background-color: #34495e;
  box-shadow: 1px 1px 7px #d3d3d3;
}

.max-height {
  height: 100%;
  min-height: 50px;
}

.m-4 {
  margin: 12px 0;
}

.my-center {
  padding-left: 10px;
}
.jus-stretch {
  justify-content: space-between;
}
</style>