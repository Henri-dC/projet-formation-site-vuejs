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
      v-for="article in ArticleStore.articles"
      :key="article"
    >
      <article>
        <time>{{ article.creation_date }}</time>
        <router-link
          class="router-link"
          :to="{ name: 'article', params: { id: article.id } }"
        >
          <h2>{{ article.title }}</h2>

          <img
            :src="`http://localhost:5173/src/assets/images/${article.picture}`"
          />
          <div class="content">
            <p>{{ article.content }}</p>
          </div>
          <div class="article-footer">
            <i @click="like" class="fa-sharp fa-solid fa-thumbs-up"></i>
          </div>
        </router-link>
      </article>
      <button
        id="edit-article"
        v-if="UserStore.getUserId === article.author_id || admin === 'true'"
        @click="editDisplay(article.id)"
      >
        Modifier
      </button>
      <button
        id="delete-article"
        v-if="admin === 'true'"
        @click="deleteArticle(article.id)"
      >
        Supprimer
      </button>
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
      this.ArticleStore.deleteArticle(id);
    },
  },
  beforeMount() {
    this.ArticleStore.queryArticles();
  },
};
</script>

<style scoped>
#main-article-container {
  display: flex;
  flex-wrap: wrap;
  width: 80%;
  margin: auto;
  margin-bottom: 4em;
  min-height: 63vh;
}

.article-container {
  width: 60%;
  margin: auto;
  background-color: rgba(175, 150, 100, 1);
  margin-top: 2em;
  text-align: center;
  padding: 1em;
  border-radius: 1em;
}

time {
  position: relative;
  display: block;
  text-decoration: underline;
  font-family: "Gill Sans", "Gill Sans MT", Calibri, "Trebuchet MS", sans-serif;
}

h2 {
  color: firebrick;
}

.router-link {
  text-decoration: none;
  color: black;
}

img {
  width: 90%;
}

.count-like {
  background-color: rgba(253, 253, 253, 0.863);
  margin-left: 0.3em;
}

#edit-article {
  text-decoration: none;
}

.fa-duotone {
  font-style: normal;
  font-size: 1em;
  padding: 0;
}
/* RESPONSIVE */

@media screen and (min-width: 900px) {
  img {
    width: 50%;
  }
  .article-container {
    width: 40%;
  }
}
</style>
