import { defineStore } from "pinia";

export const useArticleStore = defineStore("ArticleStore", {
  state: () => ({
    articles:[""]
  }),
  getters: {},
  actions: {
    async getArticles() {
      try {
        const data = await axios.get('https://jsonplaceholder.typicode.com/users')
          this.users = data.data
        }
        catch (error) {
          alert(error)
          console.log(error)
      }
    },
    async getArticlesByUser() {
      try {
        const data = await axios.get('https://jsonplaceholder.typicode.com/users')
          this.users = data.data
        }
        catch (error) {
          alert(error)
          console.log(error)
      }
    },
    async getArticlesByDate() {
      try {
        const data = await axios.get('https://jsonplaceholder.typicode.com/users')
          this.users = data.data
        }
        catch (error) {
          alert(error)
          console.log(error)
      }
    }
  },
  })
  



