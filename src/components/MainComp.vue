<script setup>
import ArticleComp from "./ArticleComp.vue";
import NewArticleForm from "./NewArticleForm.vue";
import SelectCategoryButton from "./SelectCategoryButton.vue";
import { useServiceStore } from "../store/ServiceStore";

import { ref, reactive } from "vue";
const ServiceStore = useServiceStore();
</script>

<template>
  <div>
    <SelectCategoryButton />
    <div id="main-container">
      <ArticleComp />
    </div>
    <NewArticleForm v-show="ServiceStore.displayNewArticleForm" />
  </div>
</template>

<style scoped>
@media screen and (min-width: 900px) {
  #main-container {
    display: flex;
    flex-wrap: wrap;
  }
}
</style>
