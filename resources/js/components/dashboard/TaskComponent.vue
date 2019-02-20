<template>
  <section>
    <router-link :to="{name: 'task', params: {id: task.id}}">
      <div class="box" @click="isCardModalActive = true;clickTask(task)">
        <span>{{task.subject}}</span>
      </div>
    </router-link>
  </section>
</template>

<script>
import Comment from "./Comment.vue";
import { mapGetters } from "vuex";

export default {
  name: "TaskComponent",
  components: {
    Comment
  },
  props: ["task"],
  methods: {
    clickTask: function(task) {
      this.$store.dispatch("loadCommentsTask", task.id);
    },
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
    }
  },
  computed: {
    ...mapGetters(["getUserID", "comments"])
  }
};
</script>

<style scoped>
.taskContainer {
  position: relative;
  overflow: auto;
  max-height: 375px;
}

.card {
  border-radius: 7px;
}
</style>