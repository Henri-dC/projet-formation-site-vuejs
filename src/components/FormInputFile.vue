<template>
  <div>
    <img class="imagePreviewWrapper" :src="previewImage" @click="selectImage" />
    <input id="input-file" ref="fileInput" type="file" @input="pickFile" />
  </div>
</template>

<script setup>
import { watch, ref, onMounted, onUpdated } from "vue";

let props = defineProps(["currentFile"]);

const fileInput = ref(null);
let previewImage = ref("");
let file = ref("");

onMounted(() => {
  file = ref(fileInput.value.files);
  pickFile();
});
onUpdated(() => {
  pickFile();
});

function selectImage() {
  fileInput.value.click();
}
function reactif() {
  pickFile();
}
function pickFile() {
  if (props.currentFile && fileInput.value.files.length === 0) {
    previewImage.value = "src/assets/images/" + props.currentFile;
  } else if (fileInput.value.files.length > 0) {
    let reader = new FileReader();
    reader.onload = (e) => {
      previewImage.value = e.target.result;
    };
    reader.readAsDataURL(fileInput.value.files[0]);
  } else {
    previewImage.value =
      "http://localhost:5173/src/assets/images/icon/noun-add-image-3752744.png";
  }
}
</script>

<style scoped>
.imagePreviewWrapper {
  width: 250px;
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
