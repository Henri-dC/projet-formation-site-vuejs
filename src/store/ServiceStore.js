import { defineStore } from "pinia";

export const useServiceStore = defineStore("ServiceStore", {
  state: () => ({
    displayNewArticleForm: false,
  }),
  actions: {
    toggleDisplayNewArticleForm() {
    this.displayNewArticleForm = !this.displayNewArticleForm;
    },
  },
});
