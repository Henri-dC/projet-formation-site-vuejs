import { defineStore } from "pinia";
import { ref } from "vue";
import { fetchData } from "@/composables/useFetch";

export const useArticleStore = defineStore("ArticleStore", () => {
  const formData = ref({ category_id: "-1" });
  const articles = ref([]);
  const viewArticle = ref([]);
  const edit = ref(false);

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
    query.query().then((result) => (this.articles = result["data"]));
  }
  function queryArticlesByUser(userId) {
    let user = {};
    user["id"] = userId;
    let request = new fetchData("POST", "?route=/article/list", user);
    request.query().then((result) => (this.articles = result["data"]));
  }
  function getArticlesByCategory(cat) {
    let route = "?route=/article/list&category=" + cat;
    let request = new fetchData("GET", route);
    request.query().then((result) => (this.articles = result["data"]));
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
