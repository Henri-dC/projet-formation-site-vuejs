import { defineStore } from "pinia";

export const useArticleStore = defineStore("ArticleStore", {
  state: () => ({
    articles: [],
    editArticle: [],
  }),
  getters: {
    getArticle(state) {
      return state.articles;
    },
  },
  actions: {
    async createArticle(article){
      let url = new URL("http://localhost:8889/api/index.php");
      url.search = "?route=/article";
      return fetch(url, {
        method: "POST",
        credentials: "include",
        methode: "cors",
        header: {
          "Content-Type": "application/json; charset=UTF-8",
        },
        body: JSON.stringify(article),
      })
        .then((response) => response.json())
    },
    async queryArticles() {
      let url = new URL("http://localhost:8889/api/index.php");
      url.search = "?route=/article";
      return fetch(url, {
        method: "GET",
        credentials: "include",
        methode: "cors",
      })
        .then((response) => response.json())
        .then((result) => {
          this.articles = result["data"];
        });
    },
    async queryArticlesByUser(userId) {
      let url = new URL("http://localhost:8889/api/index.php");
      url.search = "?route=/article/list";
      let user = {};
      user["id"] = userId;

      return fetch(url, {
        method: "POST",
        mode: "cors",
        credentials: "include",
        header: {
          "Content-Type": "application/json; charset=UTF-8",
        },
        body: JSON.stringify(user),
      })
        .then((response) => response.json())
        .then((result) => {
          this.articles = result["data"];
        });
    },
    async getArticlesByCategory(cat) {
      let url = new URL("http://localhost:8889/api/index.php");
      url.search = "?route=/article/list&category=" + cat;

      return fetch(url, {
        method: "GET",
        mode: "cors",
        credentials: "include",
        header: {
          "Content-Type": "application/json; charset=UTF-8",
        },
      })
        .then((response) => response.json())
        .then((result) => {
          this.articles = result["data"];
        });
    },
    async updateArticle(article) {
      let url = new URL("http://localhost:8889/api/index.php");
      url.search = "?route=/article";

      return fetch(url, {
        method: "PUT",
        mode: "cors",
        credentials: "include",
        header: {
          "Content-Type": "application/json; charset=UTF-8",
        },
        body: JSON.stringify(article),
      })
      .then((response) => response.json())
    },

    queryArticleById(id) {
      for (let i = 0; i < this.articles.length - 1; i++) {
        if (this.articles[i].id == id) {
          this.editArticle = this.articles[i];
        }
      }
    },

    resetEditArticle() {
      this.editArticle = [];
    },
  },
});
