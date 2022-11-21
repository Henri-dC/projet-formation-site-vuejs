<template>
  <div>
    <div id="select-articles-container">
      <SearchBar />
      <SelectCategoryButton />
    </div>
    <div id="main-container">
      <ArticlesViewer />
    </div>
    <NewArticleForm v-if="ServiceStore.displayNewArticleForm" />
  </div>
</template>

<script setup>
import ArticlesViewer from "./ArticlesViewer.vue";
import NewArticleForm from "./NewArticleForm.vue";
import SearchBar from "./SearchBar.vue";
import SelectCategoryButton from "./SelectCategoryButton.vue";
import { useServiceStore } from "../store/ServiceStore";

const ServiceStore = useServiceStore();
</script>

<style>
@media screen and (min-width: 600px) {
  #select-articles-container {
    margin-top: 6em;
  }
  #container-select-category {
    margin-bottom: 1em;
  }
}
@media screen and (min-width: 900px) {
  #select-articles-container {
    margin-top: 8em;
  }
}
</style>
