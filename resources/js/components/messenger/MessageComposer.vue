<template>
    <div class="composer ">
        <textarea class="" v-model="message" @keydown.enter="send"  placeholder="Write your message..."></textarea>
        <button class="button is-full-height" @click="send">Send</button>
    </div>
</template>

<script>
export default {
    data(){
        return {
            message :''
        }
    },
    methods: {
        send(e){
            e.preventDefault();
            if (this.message === '') return false
            this.$emit('send', this.message);
            this.message = '';

        }
    }

}
</script>

<style scoped>

.composer {
    width: 100%;
    height: 50px;
}

textarea {
    resize: none;
    height: 100%;
    font-size: 19px;
    padding: 6px;
    width: 83%;
    border: 1px solid lightgray;
    margin: -5px 3px;
}
button {
    width: 12%;
    margin: -5px 3px;
    height: 100% !important;

}

</style>
