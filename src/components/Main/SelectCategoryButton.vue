<script setup>
import { useArticleStore } from "../../store/ArticleStore";
const store = useArticleStore();
</script>

<template>
  <div id="container-select-category">
    <h2>Catégories</h2>
    <button
      class="select-category-button"
      @click="store.getArticlesByCategory('musique')"
    >
      Musique
    </button>
    <button
      class="select-category-button"
      @click="store.getArticlesByCategory('sport')"
    >
      Sport
    </button>
    <button class="select-category-button" @click="store.queryArticles()">
      Tous
    </button>
    <button class="select-category-button" @click="store.queryArticles()">
      Tous
    </button>
    <button class="select-category-button" @click="store.queryArticles()">
      Tous
    </button>
    <button class="select-category-button" @click="store.queryArticles()">
      Tous
    </button>
  </div>
</template>

<style scoped>
#container-select-category {
  margin-top: 10em;
  text-align: center;
  width: 80vw;
  margin-left: 10vw;
}
.select-category-button {
  position: relative;
  margin: 1vw;
  background-color: white;
  border: 0 solid #e5e7eb;
  box-sizing: border-box;
  border-radius: 10em;
  font-size: 1rem;
  font-weight: 700;
  line-height: 1.75rem;
  padding: 0.75rem 1.65rem;
  width: 100%;
  max-width: 460px;
  cursor: pointer;
  user-select: none;
}

.select-category-button::before {
  content: "";
  background: linear-gradient(
    45deg,
    #ff0000,
    #ff7300,
    #fffb00,
    #48ff00,
    #00ffd5,
    #ff00c8,
    #ff0000
  );
  position: absolute;
  top: -2px;
  left: -2px;
  background-size: 400%;
  z-index: -1;
  filter: blur(5px);
  -webkit-filter: blur(5px);
  width: calc(100% + 4px);
  height: calc(100% + 4px);
  animation: glowing-button-85 40s linear infinite;
  transition: opacity 0.3s ease-in-out;
  border-radius: 10px;
}

.select-category-button::after {
  z-index: -1;
  content: "";
  position: absolute;
  width: 100%;
  height: 100%;
  background: white;
  left: 0;
  top: 0;
  border-radius: 10px;
}

@keyframes glowing-button-85 {
  0% {
    background-position: 0 0;
  }
  50% {
    background-position: 400% 0;
  }
  100% {
    background-position: 0 0;
  }
}
</style>
