import { defineStore } from "pinia";
import { fetchData } from "@/composables/useFetch";
import { ref } from "vue";

export const useUserStore = defineStore("UserStore", () => {
  const user = ref(JSON.parse(localStorage.getItem("user")));

  function getUserId() {
    return this.user ? this.user._id : "";
  }

  function logout() {
    this.user = null;
    localStorage.removeItem("user");
    window.location.reload;
    let request = new fetchData("DELETE", "?route=/logout");
    request.query();
    window.location = "https://www.tontonriton.com";
  }

  function getUsers() {
    let request = new fetchData("GET", "?route=/account");
    return request.query();
  }

  function updateUser(user) {
    let request = new fetchData("PUT", "?route=/account", user);
    request.query();
  }

  function deleteUser(id) {
    let request = new fetchData("DELETE", "?route=/account&id=" + id);
    request.query();
  }

  return { user, logout, getUsers, updateUser, deleteUser, getUserId };
});
