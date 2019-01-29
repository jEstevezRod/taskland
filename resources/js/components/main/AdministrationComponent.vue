<template>
    <section class="container">
        <div class="columns is-multiline features">
            <target-component class="animated zoomIn" v-for="item in items" :item="item"></target-component>
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
                    {id: 1, title: 'Dashboard', description: 'Manage and see all your task in progress or finished', image:'/images/home.png'},
                    {id: 2, title: 'Calendar', description: 'You can see all your task easily in a calendar', image:'/images/calendar.png'},
                    {id: 3, title: 'Notes', description: 'Need take a quick note ? It\'s your place!', image:'/images/note.png'},
                    {id: 4, title: 'Messages', description: 'Easy way to communicate with your teammates', image:'/images/question.png'},
                ]
            }
        }
    }
</script>

<style scoped>

    .features {
        padding: 5rem 0;
    }

    .animated {
        transition: all 0.1s;
    }

    .animated:hover
{
        
        transform: scale(1.03);
}
</style>