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
#main-article-container {
  display: flex;
  flex-wrap: wrap;
  width: 80%;
  margin: auto;
  margin-bottom: 4em;
  min-height: 63vh;
}

.article-container {
  position: relative;
  margin: auto;
  margin-top: 2em;
  /* background-color: var(--second-bg-color);*/
  text-align: center;
  padding: 1em;
  border-radius: 1em;
  box-shadow: 2px 2px 2px 1px var(--main-bg-color);
}

time {
  position: relative;
  display: block;
  font-family: "Gill Sans", "Gill Sans MT", Calibri, "Trebuchet MS", sans-serif;
}

h2 {
  color: black;
}

.router-link {
  text-decoration: none;
  color: black;
}

.content {
  word-break: normal;
  white-space: pre-wrap;
}

#edit-article {
  position: relative;
  top: 0%;
  right: -45%;
  text-decoration: none;
  cursor: pointer;
}

#delete-article {
  position: relative;
  top: 0%;
  right: 45%;
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

.footer-article {
  position: absolute;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
  padding-bottom: 0.5em;
}

/* RESPONSIVE */

@media screen and (min-width: 900px) {
  #main-article-container {
    display: grid;
    grid-template-columns: repeat(8, 1fr);
    gap: 4px;
  }

  .article-container {
    position: relative;
    margin: 0;
    grid-column: span 2;
  }

  .article-container:nth-child(7n + 1) {
    grid-column: 1 / span 2;
  }
  .article-container:nth-child(7n + 2) {
    grid-column: 3 / span 2;
  }
  .article-container:nth-child(7n + 3) {
    grid-column: 5 / span 2;
  }
  .article-container:nth-child(7n + 4) {
    grid-column: 7 / span 2;
  }
  .article-container:nth-child(7n + 5) {
    grid-column: 1 / span 2;
  }
  .article-container:nth-child(7n + 6) {
    grid-column: 3 / span 4;
  }
  .article-container:nth-child(7n + 7) {
    grid-column: 7 / span 2;
  }


  /* Sélectionne le dernier sur 1 (modulo 7) */

   .article-container:last-child:nth-child(7n+1){
    grid-column-start: 1;
    grid-column-end: 9;
  }

  /* Sélectionne les deux derniers sur 2 (modulo 7) */

   .article-container:last-child:nth-child(7n+2){
    grid-column-start: 5;
    grid-column-end: 9;
  }

  .article-container:nth-last-child(2):nth-child(7n+1){
    grid-column-start: 1;
    grid-column-end: 5;
  }

  /* Sélectionne les trois derniers sur 3 (modulo 7) */

   .article-container:last-child:nth-child(7n+3){
    grid-column-start: 7;
    grid-column-end: 9;
  }

  .article-container:nth-last-child(2):nth-child(7n+2){
    grid-column-start: 3;
    grid-column-end: 7;
  }

  .article-container:nth-last-child(3):nth-child(7n+1){
    grid-column-start: 1;
    grid-column-end: 3;
  }
  
  /* Sélectionne le dernier sur 5 ( modulo 7) */

   .article-container:last-child:nth-child(7n+5){
    grid-column-start: 1;
    grid-column-end: 9;
  }

  /* Sélectionne les deux derniers sur 6 (modulo 7) */

   .article-container:last-child:nth-child(7n+6){
    grid-column-start: 5;
    grid-column-end: 9;
  }

  .article-container:nth-last-child(2):nth-child(7n+5){
    grid-column-start: 1;
    grid-column-end: 5;
  }

}
</style>
