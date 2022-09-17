<script setup>
import Article from "./Article.vue";
import NewArticleForm from "./NewArticleForm.vue";
import { useArticleStore } from "../../store/ArticleStore";
const store = useArticleStore();
</script>

<template>
  <div>
  <div id="select-category">
    <button @click="getArticlesByCategory('musique')">Musique</button>
    <button @click="getArticlesByCategory('sport')">Sport</button>
    <button @click="getAllArticles()">Tous</button>
  </div>
  <div id="main-container">
    <Article />
  </div>
  <NewArticleForm />
</div>
</template>

<script>
  export default {
    methods: {
      getArticlesByCategory(cat){
        this.store.getArticlesByCategory(cat)
      },
      getAllArticles(){
        this.store.queryArticles()
      }
    },
  };
  </script>
  

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
