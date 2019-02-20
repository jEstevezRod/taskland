<template>
  <div class="card">
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
            Project: {{task.project_id}}
            <span v-if="task.team_id">Team: {{task.team_id}}</span>
          </p>
          <p class="subtitle is-6">[ list of people whos has this task assigned]</p>
        </div>
      </div>

      <div class>
        <p>Title: {{task.subject}}</p>
        <p>Description: {{task.description}}</p>

        <span class="is-fullwidth is-pulled-right">
          <small>{{ task.created_at }}</small>
          <span v-if="task.dueDate">
            -params
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
      textComment: ""
    };
  },
  mounted() {
    this.$store.dispatch("loadTask", this.task_id);
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
