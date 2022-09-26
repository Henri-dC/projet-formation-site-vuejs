<script setup>
import ArticleComp from "../../components/ArticleComp.vue";
import NewArticleForm from "../../components/NewArticleForm.vue";
import { useServiceStore } from "../../store/ServiceStore";
const ServiceStore = useServiceStore();
</script>

<template>
  <div id="container">
    <ArticleComp admin="true" />
    <NewArticleForm v-show="ServiceStore.displayNewArticleForm" />
  </div>
</template>

<style scoped>
#container {
  padding-top: 8em;
  background-color: aqua;
}
</style>
