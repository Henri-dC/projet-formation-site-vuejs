<script setup>
import ArticleComp from "../Articles/ArticleComp.vue";
import NewArticleForm from "../Articles/NewArticleForm.vue";
import SelectCategoryButton from "../Articles/SelectCategoryButton.vue";
</script>

<template>
  <div>
    <SelectCategoryButton />
    <div id="main-container">
      <ArticleComp />
    </div>
    <NewArticleForm />
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
