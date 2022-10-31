<script setup>
import { useUserStore } from "../store/UserStore";
import { useArticleStore } from "../store/ArticleStore";
import { useServiceStore } from "../store/ServiceStore";
const UserStore = useUserStore();
const ArticleStore = useArticleStore();
const ServiceStore = useServiceStore();
</script>
s

<template>
  <div id="main-article-container">
    <div
      class="article-container"
      v-for="(article, i) in ArticleStore.articles"
      :key="article"
      :id="'article-container-' + i"
    >
      <article>
        <i
          class="fa-solid fa-trash"
          id="delete-article"
          v-if="admin === 'true'"
          @click="deleteArticle(article.id)"
        ></i>
        <i
          id="edit-article"
          title="modifier"
          v-if="UserStore.getUserId === article.author_id || admin === 'true'"
          @click="editDisplay(article.id)"
          class="fa-solid fa-pen-to-square fa-lg"
        ></i>
        <time>{{ article.creation_date }}</time>
        <router-link
          class="router-link"
          :to="{ name: 'article', params: { id: article.id } }"
        >
          <h2>{{ article.title }}</h2>

          <img
            :src="`http://localhost:5173/src/assets/images/${article.picture}`"
          />
        </router-link>
        <div class="content">
          <p ref="p">
            {{
              article.content.length > 40
                ? article.content.split(" ").splice(0, 10).join(" ") + "..."
                : article.content
            }}
          </p>
        </div>
        <div class="footer-article">
          <i @click="like" class="fa-sharp fa-solid fa-thumbs-up"></i>
        </div>
      </article>
    </div>
  </div>
</template>

<script>
export default {
  props: ["admin"],
  methods: {
    calcUrl(url) {
      let src = new URL(url, import.meta.url);
      return src;
    },
    editDisplay(id) {
      this.ArticleStore.queryArticleById(id, "edit");
      this.ServiceStore.toggleDisplayNewArticleForm();
    },
    deleteArticle(id) {
      if (confirm("Voulez-vous supprimer cet article ?")) {
        this.ArticleStore.deleteArticle(id);
        setTimeout(this.ArticleStore.queryArticles, 5000);
      }
    },
  },
  beforeMount() {
    this.ArticleStore.queryArticles();
  },
};
</script>

<style scoped>
@import '../assets/style/ArticleComp.scss'
</style>
