<script setup>
   import { useArticleStore } from "../../store/ArticleStore";
const store = useArticleStore();
</script>

<template>
   <div id="select-category">
    <button class="select-category-button" @click="store.getArticlesByCategory('musique')">Musique</button>
    <button class="select-category-button" @click="store.getArticlesByCategory('sport')">Sport</button>
    <button class="select-category-button" @click="store.queryArticles()">Tous</button>
  </div>
</template>

<style scoped>
    .select-category-button{
        border-radius: 3em;
        border-color: white;
        margin:1em;
        cursor:pointer;
        font-size: 1.3em;
       
    }
</style>