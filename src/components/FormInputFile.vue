<template>
  <div>
    <img
      class="imagePreviewWrapper"
      :src="previewImage"
      @click="selectImage"
    />
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
      previewImage: "",
    };
  },
  methods: {
    selectImage() {
      this.$refs.fileInput.click();
    },
    pickFile() { 
    let input = this.$refs.fileInput;
    let file = input.files;
    if (this.currentFile !== undefined && !file[0]) {
      console.log(1)
      this.previewImage = "src/assets/images/" + this.currentFile;
    } else if (file && file[0]) { console.log(2)
      let reader = new FileReader();
      reader.onload = (e) => {
        this.previewImage = e.target.result;
      };
      reader.readAsDataURL(file[0]);
    } else if(this.currentFile==undefined){
       console.log(3)
      this.previewImage = "src/assets/images/icon/noun-add-image-3752744.png";
    }
    },
  },
  updated() {
    this.pickFile()
  },
  mounted(){
     this.pickFile()
  }
};
</script>
<style scoped>
.imagePreviewWrapper {
  width:250px;
 
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
