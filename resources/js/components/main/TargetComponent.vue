<template>

    <div class="column is-3 is-10-mobile is-offset-1-mobile ">
        <div class="card is-shady">
            <div class="card-image has-text-centered">
                <img :src="item.image" class="has-margin5 image-target" alt="">
            </div>
            <div class="card-content">
                <div class="content">
                    <h4 class="has-text-centered"> {{ item.title }} </h4>
                    <router-link to="/dashboard"></router-link>
                    <p>{{ item.description}}</p>
                    <p class="has-text-centered"><router-link :to="{ path: item.title }" class="button is-danger">Ir a {{ item.title }}</router-link></p>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "TargetComponent",
        props: {
            item: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                image_src: '../../../public/images/home.png',
            }
        }
    }
</script>

<style scoped>
    .has-margin5 {
        margin: 45px 30px 20px 30px;
    }
    .image-target {
        width: 100px;
        height: 100px;
    }
</style>