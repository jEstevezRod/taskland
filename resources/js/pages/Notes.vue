<template>
    <div class="columns">
        <div class="column is-12 is-10-mobile is-offset-1-mobile has-page-height">

            <div class="columns is-full-height">
                <div class="column is-3">
                    <div>Your notes: </div>
                    <section>
                        <div class="box">sadsadsad</div>
                        <div class="box">sadsadsad</div>
                        <div class="box">sadsadsad</div>
                        <div class="box">sadsadsad</div>
                    </section>
                </div>

                <div class="column is-9 is-full-height">
                    <div class="columns">
                        <div class="column is-12">Holaaa</div>
                    </div>
                    <div class="columns editor is-12 is-full-height">
                        <div class="column is-6 is-full-height">
                            <textarea class="is-full-width has-padding-15" autofocus rows="55" v-model="input" @input="update"></textarea>
                        </div>
                        <div class="column is-6  is-full-height">
                            <div v-html="compiledMarkdown"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>
<script>
    import marked from 'marked';
    import _ from 'lodash';

    export default {
        data() {
            return {
                input: '',
            }
        },
        computed: {
            compiledMarkdown: function () {
                return marked(this.input, {sanitize: true})
            }
        },
        methods: {
            update: _.debounce(function (e) {
                this.input = e.target.value
            }, 300)
        }
    }
</script>
<style scoped>
    .editor {
        font-family: 'Helvetica Neue', Arial, sans-serif;
    }

    textarea {
        border: none;
        border-right: 1px solid #ccc;
        border-left: 1px solid #ccc;
        font-family: 'Monaco', courier, monospace;
    }

    code {
        color: #f66;
    }
</style>