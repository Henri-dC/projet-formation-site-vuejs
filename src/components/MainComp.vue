<template>
  <div>
    <SelectCategoryButton />
    <div id="main-container">
      <ArticleComp />
    </div>
    <NewArticleForm v-if="ServiceStore.displayNewArticleForm" />
  </div>
</template>

<script setup>
import ArticleComp from "./ArticleComp.vue";
import NewArticleForm from "./NewArticleForm.vue";
import SelectCategoryButton from "./SelectCategoryButton.vue";
import { useServiceStore } from "../store/ServiceStore";

import { ref, reactive } from "vue";
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
