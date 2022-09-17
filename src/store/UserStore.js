import { defineStore } from "pinia";

export const useUserStore = defineStore("UserStore", {
  state: () => ({
    user: JSON.parse(localStorage.getItem("user")),
  }),
  getters: {
    getUserId(){
      if(this.user==undefined){return ""}else{ return this.user._id}
    }
  },
  actions: {
    logout() {
      this.user = null;
      localStorage.removeItem("user");
      window.location.reload;
    },
  },
});
