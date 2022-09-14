import { defineStore } from "pinia";

export const useUserStore = defineStore("UserStore", {
  state: () => ({
    user: JSON.parse(localStorage.getItem("user")),
  }),
  getters: {},
  actions: {
    logout() {
      this.user = null;
      localStorage.removeItem("user");
      window.location.reload;
    },
  },
});
