<template>
  <div class="">
    <div class="card-content">
      <div class="media">
        <div class="media-content">

            <button class="button" @click="goBack">
                <span class="icon is-small">
              <i class="fas fa-arrow-left is-size-5"></i>
                </span>
                <span>Back</span>
            </button>
            <p class="title is-4 has-text-centered has-padding-top-10">
            Project:  {{project['p_name'] }}
          </p>
          <div class="has-margin-top-15">
          <p class="subtitle is-6 " v-if="users_assigned.length > 0"><strong>Assigned to: </strong>
            <span v-for="(assigned, index) in users_assigned"> {{assigned.name}}{{ index == (users_assigned.length - 1) ? '' : ', '}}
            </span>
          </p>
          <p class="subtitle is-6" v-else><small class="is-italic has-text-weight-semibold">This task has not been assigned to anyone</small></p></div>
        </div>
      </div>

      <div class>
        <br>
        <p><strong>Title:</strong>  {{task.subject}}</p>
        <p><strong>Description:</strong>  {{task.description}}</p>

        <span class="is-fullwidth is-pulled-right">
          <small>{{ task.created_at }}</small>
          <span v-if="task.dueDate">
            -
            <small class="has-text-danger">DUE DATE: {{ task.dueDate}}</small>
          </span>
        </span>
        <br>

        <hr>
        <form @submit.prevent="addNewComment">
          <div class="field">
            <label class="label">Message</label>
            <div class="control">
              <textarea
                class="textarea"
                v-model="textComment"
                placeholder="Add a comment in this task..."
                required
                autocomplete="off"
              ></textarea>
            </div>
          </div>
          <div class="is-field">
            <div class="control has-text-right">
              <button type="submit" class="button is-info">Submit</button>
            </div>
          </div>
        </form>
        <hr>
        <div class="taskContainer columns">
          <div class="column">
            <comment v-for="com in comments" :comment="com"></comment>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import Comment from "../components/dashboard/Comment.vue";

export default {
  components: {
    Comment
  },
  data() {
    return {
      task_id: this.$route.params.id,
      textComment: "",
      users_assigned: [],
      project: []
    };
  },
  mounted() {
    this.$store.dispatch("loadUser");
    this.$store.dispatch("loadTask", this.task_id)
            .then( response =>{
              this.project = response[0] })
    this.$store.dispatch("loadAssignedUsersTask", this.task_id)
            .then( tasks => this.users_assigned = tasks)
  },
  computed: {
    ...mapGetters(["getUserID", "comments", "task"])
  },
  methods: {
    addNewComment: function() {
      this.$store
        .dispatch("newComment", {
          text: this.textComment,
          author_id: this.getUserID,
          task_id: this.task.id
        })
        .then(response => {
          this.textComment = "";
          this.$toast.open({
            duration: 3000,
            message: response.data.message,
            position: "is-top",
            type: "is-success"
          });
        });
    },
    goBack: function() {
      this.$router.go(-1);
    }
  }
};
</script>

<style>
</style>
