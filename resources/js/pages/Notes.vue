<template>
  <div class="columns">
    <!-- full-container -->
    <div class="column is-12 is-10-mobile is-offset-1-mobile full-height">
      <div class="columns has-page-height">
        <!-- sidebar -->
        <div class="column is-3 max-height">
          <div class="columns">
            <div
              class="column is-8-mobile is-offset-2-mobile is-12-desktop has-margin-top-50 padding0"
            >
              <p class="title has-text-centered">Notes
                <button
                  class="button is-success has-margin-bottom-20 has-margin-left-10"
                  @click="createEmptyNote"
                >
                  <i class="fas fa-plus has-padding-right-10"></i>New
                </button>
              </p>
              <section>
                <div v-if="noteArray.length === 0" class="is-flex justify-center">You don't have notes.</div>
                <div
                  class="box1 is-flex justify-start align-center has-padding-left-20"
                  v-for="note of noteArray"
                  @click="actualNote = note"
                  :id="note.id"
                  :class="{ active : note.id === actualNote.id, 'has-text-white': note.id === actualNote.id}"
                >{{note.title}}</div>
              </section>
            </div>
          </div>
        </div>

        <div class="column is-9 is-full-height" v-if="noteArray.length !== 0">
          <!-- header -->
          <div class="columns has-min-height-100">
            <div class="column is-6 has-padding-15" >
              <label for="title">Title:</label>
              <input
                type="text"
                autocomplete="off"
                id="title"
                class="my-input"
                v-model="actualNote.title"
                placeholder="Introduce your title"
              >
            </div>
            <div class="column is-6 has-padding-15">
              <div class="is-full-height is-full-width flex">
                <span class="align-end is-pulled-right bottom-0">
                  <button class="button is-info" @click="updateNote">
                    <i class="fas fa-save has-padding-right-10"></i>Save
                  </button>
                  <button class="button is-danger" @click="deleteNote">
                    <i class="fas fa-trash has-padding-right-10"></i> Delete
                  </button>
                </span>
              </div>
            </div>
          </div>
          <!-- editor -->
          <div class="columns editor is-12 is-full-height">
            
            <!-- writer -->
            <div class="column is-6 full-height padding0">
              <div class="is-full-width has-padding-15 border">
                <textarea
                  class="is-full-width overflow"
                  autofocus
                  rows="47"
                  v-model="actualNote.text"
                  @input="update"
                  placeholder="Introduce your text here..."
                ></textarea>
              </div>
            </div>
            <!-- viewer -->
            <div class="column full-height viewer">
              <div class="is-full-width has-padding-right-5">
                <div
                  v-html="compiledMarkdown "
                  style="max-height:78vh;"
                  class=" is-8-mobile is-offset-2-mobile is-8-desktop is-offset-2-desktop broke-words overflow"
                ></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import marked from "marked";
import _ from "lodash";
import { mapGetters } from "vuex";

export default {
  data() {
    return {
      notes: [],
      actualNote: { text: "", title: "", shared: false },
      showNoNotesError: false,
    };
  },

  methods: {
    update: _.debounce(function(e) {
      this.actualNote.text = e.target.value;
    }, 300),
    createEmptyNote() {
      this.$store.dispatch("createNotes", {
        text: "",
        title: "",
        shared: false
      }).then( response => {
        this.actualNote = this.noteArray[this.noteArray.length - 1]
      })
      
    },
    updateNote() {
      this.$store
        .dispatch("updateNote", {
          data: this.actualNote,
          id: this.actualNote.id
        })
        .then(response => {
          if (response.code === 200) {
            this.$toast.open({
              duration: 3000,
              message: `Message updated correctly`,
              position: "is-top",
              type: "is-success"
            });
          }
          if (response.code === 405 || response.code === 500) {
            this.$toast.open({
              duration: 3000,
              message: response.message,
              position: "is-top",
              type: "is-danger"
            });
          }
        });
    },
    deleteNote() {
      if (this.actualNote.id) {
        this.$store
          .dispatch("deleteNote", this.actualNote.id)
          .then(response => {
            if (response.eliminated) {
              if (this.noteArray.length !== 0) {
                this.actualNote = this.noteArray[this.noteArray.length - 1];
              } else {
                this.showNoNotesError = true
              }
              this.$toast.open({
                duration: 3000,
                message: `Note eliminated correctly`,
                position: "is-top",
                type: "is-danger"
              });
            }
          });
      } 
    }
  },
  mounted() {
    this.$store.dispatch("loadNotes").then(
      response => {
        this.actualNote = this.noteArray[0]
        });
  },
  computed: {
    compiledMarkdown: function() {
      let marked = require("marked");
      let renderer = new marked.Renderer();

      marked.setOptions({
        sanitize: true
      });

      renderer.heading = function(text, level) {
        let size;
        if (level === 1) {
          size = " title is-1 ";
        } else if (level === 2) {
          size = " title is-3 ";
        } else if (level === 3) {
          size = " title is-5 ";
        }
        return `<p class="${size}">${text}</p>`;
      };

      renderer.list = (string, orderer) => {
        return `<p>${string}</p>`;
      };

      return marked(this.actualNote.text, { renderer: renderer });
    },
    ...mapGetters(["noteArray"])
  }
};
</script>
<style scoped>
.max-height{
  overflow: auto;
  max-height: 100vh;
}
.viewer {
  border: 1px solid rgba(94, 94, 94, 0.3);
}
.active {
  background-color: rgb(245, 83, 83);
}
.padding0 {
  padding: 0;
}
.overflow {
  overflow-y: auto !important;
}
.editor {
  font-family: "Helvetica Neue", Arial, sans-serif;
}
.flex {
  display: flex;
  justify-content: flex-end;
  align-items: flex-end;
}

.max-height {
  max-height: 90vh;
}

input#title {
  height: 55px;
  border: none;
  outline: none;
  font-size: 35px;
  border-bottom: 1px solid rgba(245, 83, 83, 0.4);
  width: 100%;
}
input#title:focus {
  border-bottom: 1px solid rgba(64, 107, 199, 0.4);
}
.bottom0 {
  bottom: 0;
}

.border {
  border: 1px solid rgba(94, 94, 94, 0.3);
}
.broke-words {
  word-break: break-all;
}
.box1 {
  border: 1px solid rgba(204, 204, 204, 0.712);
  word-break: break-all;
  border-radius: 1px;
  min-height: 70px;
      align-items: center;
}
.box1:last-child {
  border-bottom: 1px solid #ccc;
}
.box1:hover {
  background-color: #44aeb6b0;
}

textarea {
  resize: none;
  border: none;
    font-family: "Monaco", courier, monospace;

}
textarea:focus {
  border: 0 none #fff;
  overflow: hidden;
  outline: none;
}
.full-height {
  height: 80vh;
}
</style>