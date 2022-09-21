<script setup>
import { useArticleStore } from "../../store/ArticleStore.js";
const articleStore = useArticleStore();
</script>

<template>
  <article id="article-container">
    <h2>{{ this.articleStore.editArticle.title }}</h2>
    <img
      :src="`http://127.0.0.1:5173/src/assets/images/${this.articleStore.editArticle.picture}`"
    />
    <div class="content">
      <p>{{ this.articleStore.editArticle.content }}</p>
    </div>
    <div class="article-footer">
      <i @click="like" class="fa-sharp fa-solid fa-thumbs-up"></i>
    </div>
  </article>
</template>

<script>
export default {
  beforeMount() {
    this.articleStore.queryArticleById(this.$route.params.id);
  },
};
</script>

<style scoped>
#article-container {
  margin-top: 10em;
  display: block;
  text-align: center;
}
</style>
