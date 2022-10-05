<script setup>
import SignForm from "./SignForm.vue";
import { useUserStore } from "@/store/UserStore.js";
import { useArticleStore } from "../store/ArticleStore";
import { useServiceStore } from "../store/ServiceStore";
const store = useArticleStore();
const userStore = useUserStore();
const ServiceStore = useServiceStore();
</script>

<template>
  <div class="header-container">
    <div id="icon-burger-menu">
      <i
        v-show="userStore.user"
        class="icon fa-solid fa-bars"
        @click="toggleMenu"
      ></i>
    </div>
    <div id="menu-desktop" >
      <span class="menu-desktop-span" @click="ServiceStore.toggleDisplayNewArticleForm" v-show="userStore.user">Ecrire un article</span>
      <span class="menu-desktop-span" @click="queryArticlesUser" v-show="userStore.user">Mes articles</span>
    </div>
    <div id="container-title">
      <h1>
        <a id="link-title" href="/">Deskiñ</a>
      </h1>
    </div>
    <div v-if="!userStore.user" @click="toggleSignForm">
      <i class="icon fa-solid fa-user"></i>
    </div>
    <div v-else id="user-account" class="icon">
      <span id="user-firstname">{{ userStore.user._firstName}}</span>
      <i class="fa-solid fa-toggle-on" @click="userStore.logout()"></i>
    </div>
  </div>
  <div id="container-user-menu"> 
      <ul v-if="this.userMenu" id="list-user-menu">
        <li @click="queryArticlesUser">Mes articles</li>
        <li @click="ServiceStore.toggleDisplayNewArticleForm">
        Ecrire un article
        </li>
      </ul>
  </div>
     <SignForm v-if="this.signForm" @toggle-sign-form="toggleSignForm" />
</template>

<script>
export default {
  props: ["current_user"],
  data() {
    return {
      signForm: false,
      userMenu: false,
    };
  },

  methods: {
    toggleMenu() {
      this.userMenu = !this.userMenu;
    },
    toggleSignForm() {
      this.signForm = !this.signForm;
    },
    addArticleDisplay() {
      let container = document.querySelector(".container-for-scroll");
      container.style.display = "block";
    },
    queryArticlesUser() {
      this.store.queryArticlesByUser(this.userStore.user._id);
    },
  },
};
</script>

<style lang="sass" scoped>
@import '../assets/style/TheHeader.scss'
</style>
