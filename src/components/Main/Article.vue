<script setup>
import NewArticleForm from "./NewArticleForm.vue";
</script>

<template>
  <button id="add-article" @click="addArticleDisplay">
    <i class="fa-duotone fa-plus"></i>
  </button>
  <NewArticleForm />
  <div class="article-container" v-for="article in articles" :key="article">
    <article>
      <h2>{{ article.title }}</h2>
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
  </div>
</template>

<script>
export default {
  data() {
    return {
      articles: [],
    };
  },
  methods: {
    calcUrl(url) {
      let src = new URL(url, import.meta.url);
      return src;
    },
    addArticleDisplay() {
      let modale = document.querySelector("#modale-new-article");
      modale.style.display = "block";
    },
  },
  mounted: function getArticles() {
    let url = new URL("http://localhost:8889/api/index.php");
    url.search = "?route=/article";
    return fetch(url, {
      method: "GET",
      credentials: "include",
      methode: "cors",
    })
      .then((response) => response.json())
      .then((result) => {
        if (result["errors"]) {
          this.formErrors = result["errors"];
        } else {
          this.articles = result["data"];
          console.log(this.calcUrl(this.articles.picture));
        }
      });
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

#add-article {
  position: fixed;
  right: 2%;
  top: 20%;
  border-radius: 50%;
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
