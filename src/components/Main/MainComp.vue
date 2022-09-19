<script setup>
import ArticleComp from "./ArticleComp.vue";
import NewArticleForm from "./NewArticleForm.vue";
import SelectCategoryButton from "./SelectCategoryButton.vue";
</script>

<template>
  <div>
  <SelectCategoryButton/>
  <div id="main-container">
    <ArticleComp />
  </div>
  <NewArticleForm />
</div>
</template>

<style scoped>

#select-category{
  margin-top:10em;
  text-align: center;
}

@media screen and (min-width: 900px) {
  #main-container {
    display: flex;
    flex-wrap: wrap;
  }
}


</style>
