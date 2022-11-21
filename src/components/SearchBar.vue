<template>
  <div id="search-bar">
    <input
      placeholder="rechercher..."
      type="search"
      id="search-input"
      v-model="search"
    />
  </div>
</template>

<script setup>
import { ref } from "vue";
import { useArticleStore } from "../store/ArticleStore";
const ArticleStore = useArticleStore();
let search = ref("");
document.addEventListener("keyup", searchI);

function searchI() {
  if (search.value.length > 0) {
    ArticleStore.selectedArticles = [];
    for (let i = 0; i < ArticleStore.articles.length; i++) {
      if (
        ArticleStore.articles[i].title.includes(search.value) ||
        ArticleStore.articles[i].content.includes(search.value)
      ) {
        ArticleStore.selectedArticles.push(ArticleStore.articles[i]);
      }
    }
  } else {
    ArticleStore.selectedArticles = ArticleStore.articles;
  }
}
</script>

<style lang="scss" scoped>
#search-bar {
  text-align: center;
}

input::placeholder {
  text-align: center;
}

input {
  line-height: 2em;
  border-radius: 10px;
}

@media screen and (max-width: 900px) {
  input {
    margin-top: 3em;
  }
}
</style>
