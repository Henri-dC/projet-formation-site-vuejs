import { defineStore } from "pinia";
import { ref } from "vue";
import { fetchData } from "@/composables/useFetch";

export const useLikesStore = defineStore("LIkesStore", () => {
  const likes = ref([]);

  function getLikes() {
    let query = new fetchData("GET", "?route=/like");
    query.query().then((result) => (this.likes = result["data"]));
  }

  function addLike(articleId, userId) {
    for (var i = 0; i < likes.value.length; i++) {
      if (likes.value[i].article === articleId) {
        likes.value[i].like += 1;
      }
    }
    let data = { article: articleId, user: userId };
    let query = new fetchData("POST", "?route=/like", data);
    query.query();
  }

  function getLikeByArt(article_id) {
    for (var i = 0; i < likes.value.length; i++) {
      if (likes.value[i].article === article_id) {
        return likes.value[i].like;
      }
    }
  }

  return { likes, getLikes, addLike, getLikeByArt };
});
