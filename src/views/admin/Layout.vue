<script setup>
import AccountList from "../../components/Admin/AccountList.vue";
import AddCategoryButton from "../../components/Admin/AddCategoryButton.vue";
</script>

<template>
  <div id="sidebar">
    <ul>
      <li @click="displayAddCategory">Ajouter une catégorie</li>
      <li @click="displayShowUsers">Comptes Utilisateurs</li>
      <li><router-link to="/admin/articles" tag="button">Gérer les articles</router-link></li>
    </ul>
  </div>
  <div class="admin">
    <AddCategoryButton v-if="addCategory"/>
    <AccountList v-if="showUsers"/>
  </div>
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
    },
    displayShowUsers(){
      this.addCategory = false;
      this.showUsers= true;
    }
  }
};
 
</script>

<style scoped>
.admin {
  background-color: aqua;
  height: 70vh;
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
</style>
