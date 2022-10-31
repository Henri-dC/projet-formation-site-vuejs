<script setup>
import AccountList from "../../components/Admin/AccountList.vue";
import AddCategoryButton from "../../components/Admin/AddCategoryButton.vue";
import ArticleComp from "../../components/ArticleComp.vue";
import NewArticleForm from "../../components/NewArticleForm.vue";
import { useServiceStore } from "../../store/ServiceStore";
const ServiceStore = useServiceStore();
</script>

<template>
  <div id="sidebar">
    <ul>
      <li @click="displayAddCategory">Ajouter une catégorie</li>
      <li @click="displayShowUsers">Comptes Utilisateurs</li>
      <li @click="displayEditArticles">Gérer les articles</li>
    </ul>
  </div>
  <div class="admin">
    <AddCategoryButton v-if="addCategory"/>
    <AccountList v-if="showUsers"/>
    <ArticleComp v-if="editArticles" admin="true" />
  </div>
   <NewArticleForm v-show="ServiceStore.displayNewArticleForm" />
</template>

<script>
export default {
  name: "AdminLayout",
   data(){
    return{
      addCategory : false,
      showUsers : false,
      editArticles : false
    }
  },
  methods:{
    displayAddCategory(){
      this.addCategory = true;
      this.showUsers= false;
      this.editArticles=false;
    },
    displayShowUsers(){
      this.addCategory = false;
      this.showUsers= true;
      this.editArticles=false;
    },
    displayEditArticles(){
      this.addCategory = false;
      this.showUsers= false;
      this.editArticles=true;
    }
  }
};
 
</script>

<style scoped>
.admin {
  background-color: aqua;
  min-height: 70vh;
  width:85%;
  margin-left:15%;
  margin-top: 5em;
  text-align:center;
}

#sidebar{
  position: fixed;
  height: 70vh;
  background-color: bisque;
}

li{
  list-style-type: none;
  margin-bottom: 1em;
  font-size: 1.5em;
  padding: 0 0.5em;
  cursor : pointer;
}

ul{
  padding: 0;
}

#router-link{
  text-decoration: none;
  color:black;
}


</style>
