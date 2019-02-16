<template>
    <div class="box is-fullwidth special-box">
        <p>{{ comment.text }}</p>
        <span class="is-flex-end"> <small class="has-text-grey"> {{ comment.author}} at {{ comment.created_at }}</small> </span>
    </div>
</template>

<script>
    export default {
        name: "Comment",
        props : [ 'comment']
    }
</script>

<style scoped>
    .is-flex-end {
        display: flex;
        justify-content: flex-end;
    }

    .special-box {
        padding: 13px 8px 8px 12px;
        margin: 5px;
    }

</style>