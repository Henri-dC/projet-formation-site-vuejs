<template>
  <div id="main-article-container">
    <div
      class="article-container"
      v-for="(article, i) in ArticleStore.selectedArticles"
      :key="article"
      :id="'article-container-' + i"
    >
      <article>
        <i
          class="fa-solid fa-trash"
          id="delete-article"
          v-if="props.admin === 'true'"
          @click="deleteArticle(article.id)"
        ></i>
        <i
          id="edit-article"
          title="modifier"
          v-if="
            UserStore.getUserId() === article.author_id ||
            props.admin === 'true'
          "
          @click="editDisplay(article.id)"
          class="fa-solid fa-pen-to-square fa-lg"
        ></i>
        <time>{{ article.creation_date }}</time>
        <router-link
          class="router-link"
          :to="{ name: 'article', params: { id: article.id } }"
        >
          <h2 id="title-article">{{ article.title }}</h2>

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
          <i
            @click="addLike(article.id)"
            class="fa-sharp fa-solid fa-thumbs-up fa-xl"
          ></i
          ><data>{{ LikesStore.getLikeByArt(article.id) }}</data>
        </div>
      </article>
    </div>
  </div>
</template>

<script setup>
import { useUserStore } from "../store/UserStore";
import { useArticleStore } from "../store/ArticleStore";
import { useLikesStore } from "../store/LikesStore";
import { useServiceStore } from "../store/ServiceStore";
import { onMounted } from "vue";
const UserStore = useUserStore();
const ArticleStore = useArticleStore();
const ServiceStore = useServiceStore();
const LikesStore = useLikesStore();
const props = defineProps(["admin"]);

onMounted(() => {
  ArticleStore.queryArticles();
  LikesStore.getLikes();
});

function calcUrl(url) {
  let src = new URL(url, import.meta.url);
  return src;
}
function editDisplay(id) {
  ArticleStore.queryArticleById(id, "edit");
  ServiceStore.toggleDisplayNewArticleForm();
}
function deleteArticle(id) {
  if (confirm("Voulez-vous supprimer cet article ?")) {
    ArticleStore.deleteArticle(id);
    setTimeout(ArticleStore.queryArticles, 300);
    ServiceStore.modaleText = "L'article a été supprimé";
    ServiceStore.displayModaleText = true;
  }
}

function addLike(articleId) {
  LikesStore.addLike(articleId, UserStore.user._id);
}
</script>

<style scoped>
@import "../assets/style/ArticleComp.scss";
</style>
