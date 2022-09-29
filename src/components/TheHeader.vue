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
    <div id="menu">
      <i
        v-show="userStore.user"
        class="icon fa-solid fa-bars"
        @click="toggleMenu"
      ></i>
      <ul v-if="this.userMenu" id="user-menu">
        <li @click="queryArticlesUser">Mes articles</li>
        <li @click="ServiceStore.toggleDisplayNewArticleForm">
          Ecrire un article
        </li>
      </ul>
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
    <SignForm v-if="this.signForm" @toggle-sign-form="toggleSignForm" />
  </div>
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
  position: fixed;
  justify-content: center;
  align-items: center;
  top: 0;
  width: 100%;
  display: flex;
  justify-content: space-between;
  border-block: 3px solid black;
  background-color: var(--main-bg-color);
  z-index: 5;
}

div {
  width: 100%;
  text-align: center;
}

h1 {
  margin: 0;
  padding: 0.2em;
  font-size: 1em;
  outline: 5px solid var(--second-bg-color);
  text-shadow: 2px 4px 3px rgba(0, 0, 0, 0.3);
  font-size: 3em;
}

#title-link {
  text-decoration: none;
  color: white;
  text-shadow: #aaa;
}

i {
  cursor: pointer;
}

#menu {
  display: flex;
  list-style-type: none;
  justify-content: space-around;
  margin: 0;
  padding: 0;
  color: #eee;
  font-family: "Rubik", sans-serif;
}

.icon {
  color: var(--second-bg-color);
  color: white;
  text-shadow: 2px 4px 3px rgba(0, 0, 0, 0.3);
  font-size: 3em;
}

#user-menu {
  position: absolute;
  top: 80%;
  left: 0;
  z-index: 20;
  padding: 0;
  width:100%;
  font-family: "Rubik", sans-serif;
}

#user-menu > li {
 
  list-style-type: none;
  font-size: 2em;
  background-color: white;
  cursor: pointer;
  color: black;
  border-bottom: 2px solid black;
  border-left: 2px solid black;
  border-right: 2px solid black;
}

#user-menu > li:hover {
  background-color: var(--main-bg-color);
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

@media screen and (min-width: 600px) {
  h1 {
    margin-left: 4em;
    margin-right: 4em;
  }
  #new-article {
    display: block;
  }
  #diplay-user-firstname{
    display:inline-block;
  }
}
</style>
