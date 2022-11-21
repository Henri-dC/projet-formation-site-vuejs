<template>
  <div id="container-select-category">
    <!-- For Mobile -->
    <span
      id="display-categories-button"
      v-show="windowWidth <= 900"
      @click="ToggleSelectCategory"
    >
      Catégories <i class="fa-solid fa-chevron-down"></i>
    </span>
    <!--******************** -->
    <div v-show="showSelectCategory || windowWidth > 900">
      <div
        v-for="category in storeCategories.categories"
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

<script setup>
import { useArticleStore } from "../store/ArticleStore";
import { useCategoryStore } from "../store/CategoryStore";
import { ref, onMounted } from "vue";

const store = useArticleStore();
const storeCategories = useCategoryStore();
let windowWidth = ref(window.innerWidth);
let showSelectCategory = ref(false);

onMounted(() => {
  storeCategories.queryCategories();
  //OnResize is watching window.innerwidth for responsive button
  window.addEventListener("resize", onResize);
});

function ToggleSelectCategory() {
  showSelectCategory.value = !showSelectCategory.value;
}
function onResize() {
  windowWidth.value = window.innerWidth;
}
</script>

<style scoped>
@import "../assets/style/SelectCategoryButton.scss";
</style>
