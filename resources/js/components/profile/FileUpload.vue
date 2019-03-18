<template>
  <div class="columns">
    <div class="column is-12">
      <div class="columns">
        <div class="column is-3">
          <img :src="image" class="image">
        </div>
        <div class="column is-3">
          <input type="file" v-on:change="onFileChange" class="input">
        </div>
        <div class="column is-2">
          <button class="button is-info" @click="upload">Upload</button>
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped>
img {
  max-height: 36px;
}
</style>
<script>
export default {
  data() {
    return {
      image: ""
    };
  },
  methods: {
    onFileChange(e) {
      let files = e.target.files || e.dataTransfer.files;
      if (!files.length) return;
      this.createImage(files[0]);
    },
    createImage(file) {
      let reader = new FileReader();
      let vm = this;
      reader.onload = e => {
        vm.image = e.target.result;
      };
      reader.readAsDataURL(file);
    },
    upload() {
      axios.post("http://localhost:8000/api/auth/uploadPicture", { image: this.image }).then(response => {});
    }
  }
};
</script>