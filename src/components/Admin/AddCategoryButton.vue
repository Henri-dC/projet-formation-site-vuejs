<template>
  <div id="add-category-container">
    <h2>Ajouter une catégorie</h2>
    <input v-model="textInput" type="texte" />
    <button @click="addCategory(textInput)">Ajouter</button>
  </div>
</template>

<script setup>
import { useServiceStore } from "../../store/ServiceStore.js";
import { fetchData } from "../../composables/useFetch.js";
const ServiceStore = useServiceStore();
function addCategory(name) {
  let request = new fetchData("POST", "?route=/category", { name: name });
  request.query();
  ServiceStore.modaleText = "Catégorie " + name + " ajoutée";
  ServiceStore.displayModaleText = true;
}
</script>

<style scoped>
#add-category-container {
  position: absolute;
  left: 50%;
  transform: translate(-50%);
}
</style>
