<template>
  <div id="container">
    <ArticlesViewer admin="true" />
  </div>
</template>

<script setup>
import ArticlesViewer from "../../components/ArticlesViewer.vue";
import NewArticleForm from "../../components/NewArticleForm.vue";
import { useServiceStore } from "../../store/ServiceStore";
const ServiceStore = useServiceStore();
</script>

<style scoped>
#container {
  padding-top: 8em;
  background-color: aqua;
  padding-bottom: 5em;
}
</style>
