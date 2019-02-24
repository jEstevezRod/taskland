<template>


    <section class="mycustom">
    <bars
            :data="[{value: 0, title: ''}, {value: 1, title: 'test1'}, {value: 5, title: 'test5'}, {value: 2, title: 'test2'}, {value: 1, title: 'test1'}]"
            :gradient="['#ffbe88', '#ff93df']"
            :barWidth="5"
            :growDuration="1"></bars></section>
</template>

<script>
    export default {
        name: "Chart"
    }
</script>

<style scoped>

.mycustom {
    padding:50px;
    margin-top:100px;
}
</style>