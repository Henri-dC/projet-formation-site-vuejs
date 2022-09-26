import { defineStore } from "pinia";

export const useUserStore = defineStore("UserStore", {
  state: () => ({
    user: JSON.parse(localStorage.getItem("user")),
  }),
  getters: {
    getUserId(){
      if(this.user==undefined){return ""}else{ return this.user._id}
    },
    getUserAdmin(){
      if(this.user==undefined){return ""}else{ return this.user._isAdmin}
    }
  },
  actions: {
    logout() {
      this.user = null;
      localStorage.removeItem("user");
      window.location.reload;
    },
    getUsers(){
      let request = new fetchData('GET', "?route=/account");
      return request.query();
    },
    updateUser(user){
      let request = new fetchData('PUT', "?route=/account", user)
      request.query();
    }
  },
});
