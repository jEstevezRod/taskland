<template>

    <div class="timeline-item is-flex custom-flex">
        <div class="timeline-marker is-image is-32x32">
            <i class="fas fa-pencil-alt"></i>
        </div>
        <div class="timeline-content  transition">
            <div class="is-flex  is-lined">
            <div class=" is-rounded">
                <img class="img-custom " src="https://image.flaticon.com/icons/png/512/247/247783.png">
            </div>
            <div>
                <div class="is-flex flex-custom"><span>Pablo A.</span><span class="help">16-02-2019</span></div>
                <p>Ha creado un nuevo proyecto!</p>
            </div>
        </div></div>
    </div>
</template>

<script>
    export default {
        name: "FeedMessageComponent"
    }
</script>

<style scoped>

    .is-lined {
        padding: 20px 15px;
        border: 1px solid #a7a7a7;
        border-radius: 27px;
            box-shadow: 0 2px 3px rgba(10, 10, 10, 0.1), 0 0 0 1px rgba(10, 10, 10, 0.1);
    }

    .heading {
        text-align: left;
    }
    .img-custom {
        width: 32px;
        height: 32px;
        margin: 0 15px;
        border-radius:50%;

    }
    .flex-custom {
        justify-content: space-between;
    }
    .transition {
        transition: all .2s ease-in-out;
    }
    .transition:hover {
        transform: scale(1.05);
    }
    .timeline .timeline-item .timeline-marker.is-image.is-32x32{
        top: 44px;
    }
</style>