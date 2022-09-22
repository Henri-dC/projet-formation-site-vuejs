import { defineStore } from "pinia";

export const useCategoryStore = defineStore("CategoryStore", {
  state: () => ({
    categories:[],
  }),
  getters: {
    getCategories(state) {
      return state.categories;
    },
  },
  actions: {
    queryCategories(){
        let request = new fetchData('GET', '?route=/category')
        request.query()
        .then((result)=>this.categories=result['data']);
    }
  }
})