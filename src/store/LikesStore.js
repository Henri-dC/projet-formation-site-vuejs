/**This Store is used for managing articles's 'likes' */

import { defineStore } from "pinia";
import { ref } from "vue";
import { fetchData } from "@/composables/useFetch";

export const useLikesStore = defineStore("LIkesStore", () => {
  const likes = ref([]); //This array contain all likes {article:article_id, like:number}
  const userLikes = ref([]); //This array contain all articles liked by User ['article_id', 'article_id'...]

  function getLikes() {
    let query = new fetchData("GET", "?route=/like");
    query.query().then((result) => (this.likes = result["data"]));
  }

  function addLike(articleId, userId) {
    //First, is user already liked this article ?
    if (!userLikes.value.includes(articleId)) {
      //If not, we increase of 1 article.like
      for (var i = 0; i < likes.value.length; i++) {
        if (likes.value[i].article === articleId) {
          likes.value[i].like += 1;
        }
      }
      //We push this article in user's likes
      userLikes.value.push(articleId);
      //Update database
      let data = { article: articleId, user: userId };
      let query = new fetchData("POST", "?route=/like", data);
      query.query();
    } else {
      //If user already liked this article = delete his like
      deleteOneLike(articleId, userId);
    }
  }

  function getLikeByArt(article_id) {
    //If article is in 'likes' array, return number of likes
    for (var i = 0; i < likes.value.length; i++) {
      if (likes.value[i].article === article_id) {
        return likes.value[i].like;
      }
    }
    //else create an article with like=0
    let article = { article: article_id, like: 0 };
    likes.value.push(article);
    return article.like;
  }

  async function getLikesByUser(user_id, adminRequest) {
    let route = "?route=/like/user&user=" + user_id;
    let query = new fetchData("GET", route);
    if (!adminRequest) {
      query.query().then((result) => (this.userLikes = result["data"]));
    } else {
      return query.query();
    }
  }

  function deleteOneLike(article_id, user_id) {
    //First in javascript for dynamic aim
    for (var i = 0; i < likes.value.length; i++) {
      if (likes.value[i].article === article_id) {
        likes.value[i].like -= 1;
      }
    }
    //Then in database
    let index = userLikes.value.indexOf(article_id);
    userLikes.value.splice(index, 1);
    let route = "?route=/like/user&article=" + article_id + "&user=" + user_id;
    let query = new fetchData("DELETE", route);
    query.query();
  }

  function deleteLikes(article_id) {
    //Delete all likes to permit delete article (constraint foreign key)
    let route = "?route=/like&article=" + article_id;
    let query = new fetchData("DELETE", route);
    query.query();
  }

  //Function before deleting User : constraint foreign key Database

  async function deleteLikesByUser(user_id) {
    let request = getLikesByUser(user_id, "adminRequest");
    request.then((result) => {
      if (result["data"].length > 0) {
        for (let article of result["data"]) {
          deleteOneLike(article, user_id);
        }
      }
    });
  }

  function isLikedByUser(article_id) {
    return userLikes.value.includes(article_id);
  }

  return {
    likes,
    userLikes,
    getLikes,
    addLike,
    getLikeByArt,
    deleteLikes,
    deleteLikesByUser,
    isLikedByUser,
    getLikesByUser,
  };
});
