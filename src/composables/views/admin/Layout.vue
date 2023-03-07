<template>
  <main>
    <NewArticleForm v-show="ServiceStore.displayNewArticleForm" />
    <Transition>
      <PopUPModale
        v-if="ServiceStore.displayModaleText"
        :msg="ServiceStore.modaleText"
      />
    </Transition>
    <div id="container">
      <div>
        <SideBar id="sidebar" @select-component="(tab) => (currentTab = tab)" />
        <div id="component-viewer">
          <component
            admin="true"
            :is="tabs[currentTab]"
            class="tab"
          ></component>
        </div>
      </div>
      <div id="space"></div>
    </div>
  </main>
</template>

<script setup>
import PopUPModale from "../../components/PopUPModale.vue";
import AccountList from "../../components/Admin/AccountList.vue";
import SideBar from "../../components/Admin/Sidebar.vue";
import AddCategoryButton from "../../components/Admin/AddCategoryButton.vue";
import ArticlesViewer from "../../components/ArticlesViewer.vue";
import NewArticleForm from "../../components/NewArticleForm.vue";
import { useServiceStore } from "../../store/ServiceStore";
import { ref } from "vue";
const ServiceStore = useServiceStore();
const currentTab = ref("");
let Catégories = AddCategoryButton;
let Utilisateurs = AccountList;
let Articles = ArticlesViewer;
const tabs = {
  Catégories,
  Utilisateurs,
  Articles,
};
</script>

<style scoped>
#container {
  margin: -0.5em 0;
}

#sidebar {
  margin-top: -4em;
  position: fixed;
  width: 10%;
  float: left;
  height: 100%;
  border-right: 0.5px solid;
  background-color: bisque;
  padding: 0 1em;
}

#component-viewer {
  position: relative;
  min-height: 100vh;
  display: block;
  width: 90%;
  left: 10%;
  margin-top: 9em;
}

ul {
  padding: 0;
}

#router-link {
  text-decoration: none;
  color: black;
}

#router-link {
  text-decoration: none;
  color: black;
}
#space {
  height: 8em;
}
</style>
