<script setup>
import SignForm from "./SignForm.vue";
import { useUserStore } from "@/store/UserStore.js";
const userStore = useUserStore();
</script>

<template>
  <div class="nav-container">
    <ul id="menu">
      <li><i class="fa-solid fa-bars" @click="toggleMenu"></i>
      <ul v-if="this.userMenu" id="user-menu">
        <li>Mes articles</li>
      </ul>
      </li>
      <li id="logo-title">
        <h1>
          <a href="/">Deskiñ</a>
        </h1>
      </li>
      <li id="user-logo" @click="toggleSignForm">
        <i class="fa-solid fa-user"></i>
      </li>
    </ul>
    <SignForm v-if="this.signForm" @toggle-sign-form="toggleSignForm" />
    <div id="disconnect-user" v-show="userStore.user">
      <h5 id="user-name">{{ userStore.user ? userStore.user._firstName : "" }}</h5>
      <i class="fa-solid fa-toggle-on" @click="userStore.logout()"></i>
    </div>
    <div v-show="userStore.user" @click="addArticleDisplay" id="new-article">
      Ecrire un article
    </div>
  </div>
</template>

<script>
export default {
  props: ["current_user"],
  data() {
    return {
      signForm: false,
      userMenu:false
    };
  },

  methods: {
    toggleMenu(){
      this.userMenu=!this.userMenu
    },
    toggleSignForm() {
      this.signForm = !this.signForm;
    },
    addArticleDisplay() {
      let container = document.querySelector(".container-for-scroll");
      container.style.display = "block";
    },
  },
};
</script>

<style scoped>
.nav-container {
  position: fixed;
  top: 0;
  width: 100%;
  border-block: 3px solid black;
  background-color: var(--main-bg-color);
}

h1 {
  margin: 0;
  padding: 0.2em;
  font-size: 1em;
  outline: 5px solid var(--second-bg-color);
  text-shadow: 2px 4px 3px rgba(0, 0, 0, 0.3);
}

a {
  text-decoration: none;
  color: white;
  font-family: "Rubik", sans-serif;
  text-shadow: #aaa;
}

i {
  cursor: pointer;
}

#menu {
  display: flex;
  list-style-type: none;
  justify-content: space-around;
  align-items: center;
  font-size: 3em;
  margin: 0;
  padding: 0;
  color: #eee;
}

.fa-solid {
  color: var(--second-bg-color);
  color: white;
  text-shadow: 2px 4px 3px rgba(0, 0, 0, 0.3);
}


#user-name {
  margin: 0;
  margin-left:1em;
  margin-right:1em;

  
}

#disconnect-user {
  position: absolute;
  right: 0em;
  top: 103%;
  display: flex;
  justify-content: space-between;
  padding: 0.5em;
  font-size: 1.8em;
  background-color: var(--second-bg-color);
  border-bottom: 2px solid black;
  border-left: 2px solid black;
  border-right: 2px solid black;
}

#user-menu>li{
  list-style-type: none;
  font-size: 0.6em;
  background-color: var(--second-bg-color);
  cursor:pointer;
  color:black;
  border-bottom: 2px solid black;
  border-left: 2px solid black;
  border-right: 2px solid black;
}

#user-menu>li:hover{
  background-color: white;
}

#user-menu{
  position:absolute;
  top:103%;
  left: 0;
  z-index: 20;
  padding: 0;
  
}

#new-article{
  position: absolute;
  top: 103%;
  left:5%;
  display: flex;
  justify-content: space-between;
  padding: 0.2em;
  font-size: 1.5em;
  background-color: var(--second-bg-color);
  border-bottom: 2px solid black;
  border-right: 2px solid black;
  border-left: 2px solid black;
  cursor: pointer;
  display: none;
}

@media screen and (min-width: 600px) {
  h1 {
    margin-left: 4em;
    margin-right: 4em;
  }
  #new-article{
    display:block
  }
}
</style>
