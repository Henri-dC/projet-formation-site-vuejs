<script setup>
import Article from "./Article.vue";
</script>

<template>
  <div id="main-container">
    <Article />
  </div>
</template>

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
