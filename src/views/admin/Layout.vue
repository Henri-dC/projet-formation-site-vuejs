<template>
  <div id="sidebar">
    <ul
      v-for="(_, tab) in tabs"
      :key="tab"
      :class="['tab', { active: currentTab === tab }]"
      @click="currentTab = tab"
    >
      <li>{{ tab }}</li>
    </ul>
  </div>
  <div class="admin">
    <component admin="true" :is="tabs[currentTab]" class="tab"></component>
  </div>
  <NewArticleForm v-show="ServiceStore.displayNewArticleForm" />
</template>

<script setup>
import AccountList from "../../components/Admin/AccountList.vue";
import AddCategoryButton from "../../components/Admin/AddCategoryButton.vue";
import ArticleComp from "../../components/ArticleComp.vue";
import NewArticleForm from "../../components/NewArticleForm.vue";
import { useServiceStore } from "../../store/ServiceStore";
import { ref } from "vue";
const ServiceStore = useServiceStore();
const currentTab = ref("AddCategoryButton");
const tabs = {
  AddCategoryButton,
  AccountList,
  ArticleComp,
};
</script>

<style scoped>
.admin {
  background-color: aqua;
  min-height: 70vh;
  width: 85%;
  margin-left: 15%;
  margin-top: 5em;
  text-align: center;
}

#sidebar {
  position: fixed;
  height: 70vh;
  background-color: bisque;
}

li {
  list-style-type: none;
  margin-bottom: 1em;
  font-size: 1.5em;
  padding: 0 0.5em;
  cursor: pointer;
}

ul {
  padding: 0;
}

#router-link {
  text-decoration: none;
  color: black;
}

ul {
  padding: 0;
}

#router-link {
  text-decoration: none;
  color: black;
}
</style>
