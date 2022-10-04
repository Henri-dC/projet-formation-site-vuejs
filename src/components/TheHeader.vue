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
  <div class="nav-container">
    <div id="icon-burger-menu">
      <i
        v-show="userStore.user"
        class="icon fa-solid fa-bars"
        @click="toggleMenu"
      ></i>
    </div>
    <div id="menu-desktop" >
      <span class="menu-span" @click="ServiceStore.toggleDisplayNewArticleForm" v-show="userStore.user">Ecrire un article</span>
      <span class="menu-span" @click="queryArticlesUser" v-show="userStore.user">Mes articles</span>
    </div>
    <div id="logo-title">
      <h1>
        <a id="title-link" href="/">Deskiñ</a>
      </h1>
    </div>
    <div v-if="!userStore.user" id="user-connect" @click="toggleSignForm">
      <i class="icon fa-solid fa-user"></i>
    </div>
    <div v-else id="user-account-name" class="icon">
      <span id="diplay-user-firstname">{{ userStore.user._firstName}}</span>
      <i class="fa-solid fa-toggle-on" @click="userStore.logout()"></i>
    </div>
  </div>
  <div id="container-user-menu"> 
      <ul v-if="this.userMenu" id="user-menu">
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

<style scoped>
.nav-container {
  justify-content: center;
  align-items: center;
  width: 100%;
  display: grid;
  grid-template-columns: 1fr 1fr 1fr;
  justify-content: space-between;
  border-block: 3px solid black;
  background-color: var(--main-bg-color);
  z-index: 5;
}

#icon-burger-menu, 
#menu-desktop{
  text-align:center;
}

.menu-span{
  display:inline-block;
  font-size: 1.4em;
  color:white;
  text-decoration: underline;
  cursor:pointer;
  margin-left:1em;
  transform: rotate(-10deg);
  text-shadow: 2px 4px 3px rgba(0, 0, 0, 0.3);
}

h1 {
  margin: 0;
  padding: 0.2em;
  font-size: 1em;
  outline: 5px solid var(--second-bg-color);
  text-shadow: 2px 4px 3px rgba(0, 0, 0, 0.3);
  font-size: 3em;
  text-align: center;
  display:inline-block;
}

#logo-title{
  text-align: center;
}

#title-link {
  text-decoration: none;
  color: white;
  text-shadow: #aaa;
}

i {
  cursor: pointer;
}

.icon {
  color: white;
  text-shadow: 2px 4px 3px rgba(0, 0, 0, 0.3);
  font-size: 3em;
}

#user-menu {
  padding: 0;
  width:100%;
  margin:0;
  font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

#user-menu > li {
  list-style-type: none;
  text-align:center;
  font-size: 1.5em;
  background-color: var(--second-bg-color);
  background: linear-gradient(0deg, rgba(34,193,195,1) 0%, rgba(147,204,213,0.30996148459383754) 100%);
  cursor: pointer;
  color: black;
  border: 1px solid black;
  border-top: none;
}

#user-account-name {
  font-size: 1.4em;
  text-align: center;
}

.fa-toggle-on {
  margin-left: 1em;
}

#user-connect {
  text-align: center;
}

#diplay-user-firstname{
  display:none;
}

#menu-desktop{
  display:none;
}

@media screen and (min-width: 600px) {
  .nav-container {
  position: fixed;
  top: 0;}
 
  #diplay-user-firstname{
    display:inline-block;
  }

  #container-user-menu{
    margin-top:5em;
    margin-bottom:1em;
  }
}

@media screen and (min-width: 900px) {
  #container-user-menu, #icon-burger-menu{
    display:none;
  }
 
  #menu-desktop{
    display:inline-block;
  }
}


</style>
