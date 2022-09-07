<template>
  <div id="main-container">
    <Article id="article-main-container" />
  </div>
</template>

<script setup>
import Article from "./Article.vue";
</script>

<style scoped>
#main-container {
  margin-top: 10em;
}

@media screen and (min-width: 900px) {
  #main-container {
    display: flex;
    flex-wrap: wrap;
  }
}
</style>
