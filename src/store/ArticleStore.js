/**This Store is used for managing articles */

import { defineStore } from "pinia";
import { ref } from "vue";
import { fetchData } from "@/composables/useFetch";

export const useArticleStore = defineStore("ArticleStore", () => {
  const articles = ref([]); //Contain all articles
  let selectedArticles = ref([]); //All articles selected for display
  const viewArticle = ref([]); //Selected article for ArticleView
  const formData = ref({ category_id: "-1" }); //Use for forms
  const edit = ref(false); //For forms

  function createArticle(article) {
    let query = new fetchData("POST", "?route=/article", article);
    return query.query();
  }

  function updateArticle(article) {
    let query = new fetchData("PUT", "?route=/article", article);
    return query.query();
  }

  function queryArticles() {
    let query = new fetchData("GET", "?route=/article");
    query
      .query()
      .then((result) => (this.articles = result["data"]))
      .then((result) => (this.selectedArticles = result));
  }

  function queryArticlesByUser(userId) {
    this.selectedArticles = [];
    for (let i in this.articles) {
      if (this.articles[i].author_id === userId) {
        this.selectedArticles.push(this.articles[i]);
      }
    }
  }

  function getArticlesByCategory(cat) {
    this.selectedArticles = [];
    for (let i in this.articles) {
      if (this.articles[i].category_id === cat) {
        this.selectedArticles.push(this.articles[i]);
      }
    }
  }

  async function queryArticleById(id, mode) {
    for (let i = 0; i < this.articles.length; i++) {
      if (this.articles[i].id === id) {
        if (mode === "edit") {
          this.formData = this.articles[i];
          this.edit = true;
        } else {
          this.viewArticle = this.articles[i];
        }
      }
    }
  }

  async function deleteArticle(id) {
    await this.queryArticleById(id, "edit");
    let routeA = "?route=/picture&name=" + formData.picture;
    let requestA = new fetchData("DELETE", routeA);
    requestA.query();
    let route = "?route=/article&id=" + id;
    let request = new fetchData("DELETE", route);
    request.query();
  }

  return {
    formData,
    articles,
    selectedArticles,
    edit,
    viewArticle,
    createArticle,
    queryArticleById,
    queryArticles,
    queryArticlesByUser,
    getArticlesByCategory,
    deleteArticle,
    updateArticle,
  };
});
