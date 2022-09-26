<script setup>
import { useArticleStore } from "../../store/ArticleStore.js";
import { useServiceStore } from "../../store/ServiceStore";
import NewArticleForm from "../../components/NewArticleForm.vue";
const articleStore = useArticleStore();
const ServiceStore = useServiceStore();
</script>

<template>
  <NewArticleForm v-show="ServiceStore.displayNewArticleForm" />
  <article id="article-container">
    <h2>{{ this.articleStore.viewArticle.title }}</h2>
    <img
      :src="`http://127.0.0.1:5173/src/assets/images/${this.articleStore.viewArticle.picture}`"
    />
    <div class="content">
      <p>{{ this.articleStore.viewArticle.content }}</p>
    </div>
    <div class="article-footer">
      <i @click="like" class="fa-sharp fa-solid fa-thumbs-up"></i>
    </div>
  </article>
</template>

<script>
export default {
  beforeMount() {
    this.articleStore.queryArticleById(this.$route.params.id, "view");
  },
};
</script>

<style scoped>
#article-container {
  margin-top: 10em;
  display: block;
  text-align: center;
  min-height: 72vh;
}

img {
  max-width: 30%;
  min-width: 30%;
}
</style>
