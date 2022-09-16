<script setup>
import Article from "./Article.vue";
import NewArticleForm from "./NewArticleForm.vue";
import { useArticleStore } from "../../store/ArticleStore";
const store = useArticleStore();
</script>

<template>
  <div id="main-container">
    <div id="select-category">
    <button @click="getArticlesByCategory('musique')">Musique</button>
    <button @click="getArticlesByCategory('sport')">Sport</button>
    <button @click="getArticlesByCategory('')">Musique</button>
  </div>
    <Article />
    <NewArticleForm />
  </div>
</template>

<script>
  export default {
    methods: {
      getArticlesByCategory(cat){
        this.store.getArticlesByCategory(cat)
      }
    },
  };
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
