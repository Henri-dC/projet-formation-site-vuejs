<script setup>
import { useUserStore } from "../../store/UserStore";
import { useArticleStore } from "../../store/ArticleStore";
const UserStore = useUserStore();
const store = useArticleStore();
</script>

<template>
  <div
    class="article-container"
    v-for="article in store.articles"
    :key="article"
  >
    <article>
      <router-link :to="{ name: 'article', params: { id: article.id } }">
        <h2>{{ article.title }}</h2>
      </router-link>
      <img
        :src="`http://127.0.0.1:5173/src/assets/images/${article.picture}`"
      />
      <div class="content">
        <p>{{ article.content }}</p>
      </div>
      <div class="article-footer">
        <i @click="like" class="fa-sharp fa-solid fa-thumbs-up"></i>
      </div>
    </article>
    <button
      id="edit-article"
      v-if="UserStore.getUserId == article.author_Id || admin == 'true'"
      @click="editDisplay(article.id)"
    >
      Modifier
    </button>
    <button
      id="delete-article"
      v-if="admin == 'true'"
      @click="deleteArticle(article.id)"
    >
      Supprimer
    </button>
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
      let container = document.querySelector(".container-for-scroll");
      container.style.display = "block";
      this.store.queryArticleById(id);
    },
    deleteArticle(id) {
      this.store.deleteArticle(id);
    },
  },
  beforeMount() {
    this.store.queryArticles();
  },
};
</script>

<style scoped>
.article-container {
  width: 80%;
  margin: auto;
  background-color: rgba(253, 253, 253, 0.863);
  margin-top: 2em;
  text-align: center;
  padding: 1em;
  border: 1px solid black;
  border-radius: 1em;
}

.content {
  background-color: white;
}

h2 {
  color: firebrick;
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
