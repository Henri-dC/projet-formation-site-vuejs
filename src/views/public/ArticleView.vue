<script setup>
import { useArticleStore } from "../../store/ArticleStore.js";
import { useServiceStore } from "../../store/ServiceStore";
import NewArticleForm from "../../components/NewArticleForm.vue";
const articleStore = useArticleStore();
const ServiceStore = useServiceStore();
</script>

<template>
  <article id="article-container">
    <router-link to="/">Retour aux articles</router-link>
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
  <NewArticleForm v-if="ServiceStore.displayNewArticleForm" />
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
  display: block;
  width: 90%;
  margin: 2em auto;

  padding-bottom: 3em;
  text-align: center;
  min-height: 72vh;
  box-shadow: 2px 2px 2px 1px var(--main-bg-color);
}

img {
  max-width: 90%;
  padding-bottom: 3em;
}

.content {
  width: 30%;
  margin: auto;
  padding: 1em;
  text-align: left;
  white-space: pre-wrap;
  border-top: 1px solid black;
}

@media screen and (min-width: 600px) {
  #article-container {
    margin-top: 7em;
    width: 50%;
  }
}
</style>
