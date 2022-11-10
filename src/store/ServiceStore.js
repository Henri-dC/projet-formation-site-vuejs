import { defineStore } from "pinia";
import { ref } from "vue";

export const useServiceStore = defineStore("ServiceStore", () => {
  const displayNewArticleForm = ref(false);
  function toggleDisplayNewArticleForm() {
    this.displayNewArticleForm = !this.displayNewArticleForm;
  }
  return { displayNewArticleForm, toggleDisplayNewArticleForm };
});
