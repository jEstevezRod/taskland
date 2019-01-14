<template>
    <section class="container">
        <div class="columns is-multiline features">
            <target-component v-for="item in items" :item="item"></target-component>
        </div>
    </section>
</template>

<script>
import TargetComponent from './TargetComponent'
    export default {
        components: { TargetComponent},
        name: "AdministrationComponent",
        data() {
            return {
                items: [
                    {id: 1, title: 'dashboard', description: 'Manage and see all your task in progress or finished', image:'/images/home.png'},
                    {id: 2, title: 'calendar', description: 'You can see all your task easily in a calendar', image:'/images/calendar.png'},
                    {id: 3, title: 'notes', description: 'Need take a quick note ? It\'s your place!', image:'/images/note.png'},
                    {id: 4, title: 'messages', description: 'Easy way to communicate with your teammates', image:'/images/question.png'},
                ]
            }
        }
    }
</script>

<style scoped>

    .features {
        padding: 5rem 0;
    }

</style>