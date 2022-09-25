<template>
  <div>
    <div
      class="imagePreviewWrapper"
      :style="{ 'background-image': `url(${previewImage})` }"
      @click="selectImage"
    ></div>
    <input id="input-file" ref="fileInput" type="file" @input="pickFile" />
  </div>
</template>
<script>
export default {
  props: {
    currentFile: String,
  },
  data() {
    return {
      previewImage: ' "src/assets/images/icon/noun-add-image-3752744.png"',
    };
  },
  methods: {
    selectImage() {
      this.$refs.fileInput.click();
    },
    pickFile() {
      let input = this.$refs.fileInput;
      let file = input.files;
      if (file && file[0]) {
        let reader = new FileReader();
        reader.onload = (e) => {
          this.previewImage = e.target.result;
        };
        reader.readAsDataURL(file[0]);
      }
    },
  },
  updated() {
    let input = this.$refs.fileInput;
    let file = input.files;
    if (this.currentFile !== undefined && !file[0]) {
      this.previewImage = "src/assets/images/" + this.currentFile;
    } else if (file && file[0]) {
      let reader = new FileReader();
      reader.onload = (e) => {
        this.previewImage = e.target.result;
      };
      reader.readAsDataURL(file[0]);
    } else {
      this.previewImage = "src/assets/images/icon/noun-add-image-3752744.png";
    }
  },
};
</script>
<style scoped>
.imagePreviewWrapper {
  width: 250px;
  height: 250px;
  display: block;
  cursor: pointer;
  margin: 0 auto 30px;
  background-size: cover;
  background-position: center center;
}

#input-file {
  display: none;
}
</style>
