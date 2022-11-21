<template>
  <div>
    <SelectCategoryButton />
    <div id="main-container">
      <ArticlesViewer />
    </div>
    <NewArticleForm v-if="ServiceStore.displayNewArticleForm" />
  </div>
</template>

<script setup>
import ArticlesViewer from "./ArticlesViewer.vue";
import NewArticleForm from "./NewArticleForm.vue";
import SelectCategoryButton from "./SelectCategoryButton.vue";
import { useServiceStore } from "../store/ServiceStore";
const ServiceStore = useServiceStore();
</script>

<style scoped>
@media screen and (min-width: 900px) {
  #main-container {
    display: flex;
    flex-wrap: wrap;
  }
}
</style>
