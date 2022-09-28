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
        <div class="article-footer">
          <i @click="like" class="fa-sharp fa-solid fa-thumbs-up"></i>
        </div>
      </article>
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
      setTimeout(this.ArticleStore.queryArticles, 5000);
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
  margin: auto;
  margin-top: 2em;
  background-color: var(--second-bg-color);
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

.content {
  word-break: break-all;
}
.count-like {
  background-color: rgba(253, 253, 253, 0.863);
  margin-left: 0.3em;
}

#edit-article {
  position: relative;
  top: 0%;
  right: -45%;
  text-decoration: none;
  cursor: pointer;
}

img {
  width: 90%;
}

.fa-duotone {
  font-style: normal;
  font-size: 1em;
  padding: 0;
}
/* RESPONSIVE */

@media screen and (min-width: 900px) {
  #main-article-container {
    display: grid;
    grid-template-columns: 1fr 2fr 1fr;
    gap: 4px;
  }

  .article-container {
    margin: 0;
  }
}
</style>
