<template>
  <div class="columns">
    <!-- full-container -->
    <div class="column is-12 is-10-mobile is-offset-1-mobile full-height">
      <div class="columns is-full-height">
        <!-- sidebar -->
        <div class="column is-3">
          <div class="columns">
            <div
              class="column is-8-mobile is-offset-2-mobile is-12-desktop has-margin-top-50 padding0"
            >
              <p class="title has-text-centered">Notes   <button class="button is-success has-margin-bottom-20 has-margin-left-10">
               <i class="fas fa-plus has-padding-right-10"></i>New
              </button></p>
              <section>
                <div class="box1">sadsadsad
                </div>
                <div class="box1">sadsadsad</div>
                <div class="box1">sadsadsad</div>
                <div class="box1">sadsadsad</div>
              </section>
            </div>
          </div>
        </div>

        <div class="column is-9 is-full-height">
          <!-- header -->
          <div class="columns has-min-height-100">
            <div class="column is-11 has-padding-15">
              
              <div class="is-full-height is-full-width flex">
                            
                <span class="align-end is-pulled-right bottom-0">
                  <button class="button is-info">
                    <i class="fas fa-save has-padding-right-10"></i>Save
                  </button>
                  <button class="button is-danger">
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
                  v-model="input"
                  @input="update"
                ></textarea>
              </div>
            </div>
            <!-- viewer -->
            <div class="column full-height">
              <div class="is-full-width has-padding-15 has-margin-right-20">
                <div
                  v-html="compiledMarkdown "
                  style="max-height:78vh;"
                  class="has-padding-5 is-8-mobile is-offset-2-mobile is-8-desktop is-offset-2-desktop broke-words overflow"
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

export default {
  data() {
    return {
      input: `

# Hello, this is Markdown Live Preview

----
## What is Markdown?


> Markdown is a lightweight markup language, originally created by John Gruber and Aaron Swartz allowing people "to write using an easy-to-read, easy-to-write plain text format, then convert it to structurally valid XHTML (or HTML)".
  
see [Wikipedia](https://en.wikipedia.org/wiki/Markdown)

## usage
---
1. Write markdown text in this textarea.
2. Automatically see the preview in the right side.
3. Text attributes *italic*, **bold**, ~~strikethrough~~ .
4. images:  
 
![Alt Text](http://k30.kn3.net/taringa/7/7/9/8/3/D/guitar_gero/2B1.jpg)

# headers

## sub-headers

### titles

*emphasis*

**strong**

lists:
* 17-Feb-2013 re-design
* 23-Feb-2013 commited
* 08-Mar-2013 deployed


    sudo apt install taskland -g
[links to whatever you want](https://jestevezrod.es)

----
## thanks
* **author**: [jEstevezRod](https://jestevezrod.es)

`
    };
  },
  computed: {
    compiledMarkdown: function() {
      let marked   = require('marked');
      let renderer = new marked.Renderer();

      marked.setOptions({ 
        sanitize: true,
      });

      renderer.heading = function(text, level) {
        let size;
        if (level === 1) {
          size = 'title is-1'
        } else if (level === 2){
          size = 'title is-3'
        } else if( level === 3) {
          size = ' title is-5'
        }
         return `<p class="${size}">${text}</p>`
      }

      renderer.list = (string, orderer) => {
         return `<p>${string}</p>`
         }

      return marked(this.input, {renderer: renderer})
    }
  },
  methods: {
    update: _.debounce(function(e) {
      this.input = e.target.value;
    }, 300)
  },
  mounted() {}
};
</script>
<style scoped>
.padding0 {
  padding:0; 
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

textarea {
  border: none;
  border: 1px solid #ccc;
  font-family: "Monaco", courier, monospace;
}

.max-height {
  max-height: 90vh;
}

input#title {
  height: 55px;
  border: none;
  outline: none;
  font-size: 35px;
}
.bottom0 {
  bottom: 0;
}

.border {
  border: 1px solid #ccc;
}
.broke-words {
  word-break: break-all;
}
.box1 {
  border-left: 1px solid #ccc;
  border-top: 1px solid #ccc;
  padding: 20px;
  word-break: break-all;
  border-radius: 1px;
}
.box1:last-child {
  border-bottom: 1px solid #ccc;
}
.box1:hover {
  background-color: #badc58;
}

textarea {
  resize: none;
  border: none;
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