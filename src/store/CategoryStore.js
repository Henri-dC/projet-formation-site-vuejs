import { defineStore } from "pinia";
import { ref } from "vue";
import { fetchData } from "@/composables/useFetch";

export const useCategoryStore = defineStore("CategoryStore", () => {
  let categories = ref([]);

  function queryCategories() {
    let request = new fetchData("GET", "?route=/category");
    request.query().then((result) => (this.categories = result["data"]));
  }

  return { categories, queryCategories };
});
