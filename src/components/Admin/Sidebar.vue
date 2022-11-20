<template>
  <div id="sidebar">
    <ul
      v-for="(_, tab) in tabs"
      :key="tab"
      :class="['tab', { active: currentTab === tab }]"
      @click="$emit('selectComponent', tab)"
    >
      <li>{{ tab }}</li>
    </ul>
  </div>
</template>

<script setup>
import { ref } from "vue";
import AccountList from "../../components/Admin/AccountList.vue";
import AddCategoryButton from "../../components/Admin/AddCategoryButton.vue";
import ArticleComp from "../../components/ArticleComp.vue";
let Catégories = AddCategoryButton;
let Utilisateurs = AccountList;
let Articles = ArticleComp;
const currentTab = ref("Catégories");
const tabs = {
  Catégories,
  Utilisateurs,
  Articles,
};
</script>

<style scoped>
ul {
  padding: 0;
}

li {
  list-style-type: none;
  cursor: pointer;
  padding: 0.6em;
  border-radius: 10px;
  text-align: right;
  background-color: grey;
  color: white;
}

li:hover {
  color: black;
  box-shadow: 2px 2px 2px grey;
}
</style>
