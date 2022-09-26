import { defineStore } from "pinia";

export const useArticleStore = defineStore("ArticleStore", {
  state: () => ({
    articles: [],
    editArticle: [],
    viewArticle: [],
  }),
  getters: {
    getArticle(state) {
      return state.articles;
    },
  },
  actions: {
    createArticle(article) {
      let query = new fetchData("POST", "?route=/article", article);
      return query.query();
    },
    queryArticles() {
      let query = new fetchData("GET", "?route=/article");
      query.query().then((result) => (this.articles = result["data"]));
    },
    queryArticlesByUser(userId) {
      let user = {};
      user["id"] = userId;
      let request = new fetchData("POST", "?route=/article/list", user);
      request.query().then((result) => (this.articles = result["data"]));
    },
    getArticlesByCategory(cat) {
      let route = "?route=/article/list&category=" + cat;
      let request = new fetchData("GET", route);
      request.query().then((result) => (this.articles = result["data"]));
    },
    updateArticle(article) {
      let request = new fetchData("PUT", "?route=/article", article);
      return request.query();
    },

    queryArticleById(id, mode) {
      for (let i = 0; i < this.articles.length; i++) {
        if (this.articles[i].id === id) {
          if (mode === "edit") {
            this.editArticle = this.articles[i];
          } else {
            this.viewArticle = this.articles[i];
          }
        }
      }
    },

    deleteArticle(id) {
      let route = "?route=/article&id=" + id;
      let request = new fetchData("DELETE", route);
      request.query();
    },

    resetEditArticle() {
      this.editArticle = [];
    },
  },
});
