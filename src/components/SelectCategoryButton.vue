<script setup>
import { useArticleStore } from "../store/ArticleStore";
import { useCategoryStore } from "../store/CategoryStore";
const store = useArticleStore();
const storeCategories = useCategoryStore();
storeCategories.queryCategories();
</script>

<template>
  <div id="container-select-category">
    <h2 v-show="windowWidth <= 900" @click="ToggleSelectCategory">
      Catégories <i class="fa-solid fa-chevron-down"></i>
    </h2>
    <div v-show="showSelectCategory || windowWidth > 900">
      <div
        v-for="category in storeCategories.getCategories"
        :key="category.id"
        id="open-select-category"
      >
        <button
          class="select-category-button"
          @click="store.getArticlesByCategory(category.id)"
        >
          {{ category.name }}
        </button>
      </div>
      <button class="select-category-button" @click="store.queryArticles()">
        Tous
      </button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      showSelectCategory: false,
      windowWidth: window.innerWidth,
    };
  },
  mounted() {
    this.$nextTick(() => {
      window.addEventListener("resize", this.onResize);
    });
  },
  methods: {
    ToggleSelectCategory() {
      this.showSelectCategory = !this.showSelectCategory;
    },
    onResize() {
      this.windowWidth = window.innerWidth;
    },
  },
};
</script>

<style scoped>
@import '../assets/style/SelectCategoryButton.scss';
</style>
