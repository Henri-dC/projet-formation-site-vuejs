<script setup>
import SignForm from "./SignForm.vue";
import { useUserStore } from "@/store/UserStore.js";
const userStore = useUserStore();
</script>

<template>
  <div class="nav-container">
    <ul id="menu">
      <li><i class="fa-solid fa-bug"></i></li>
      <li id="logo-title">
        <h1>
          <a href="/">Deskiñ</a>
        </h1>
      </li>
      <li @click="toggleSignForm">
        <i class="fa-solid fa-user"></i>
      </li>
    </ul>
    <SignForm v-if="this.signForm" @toggle-sign-form="toggleSignForm" />
    <div id="menu-user" v-show="userStore.user">
      <i class="fa-solid fa-caret-down"></i>
      <h5>{{ userStore.user ? userStore.user._firstName : "" }}</h5>
      <i class="fa-solid fa-toggle-on" @click="userStore.logout()"></i>
    </div>
  </div>
</template>

<script>
export default {
  props: ["current_user"],
  data() {
    return {
      signForm: false,
    };
  },

  methods: {
    toggleSignForm() {
      this.signForm = !this.signForm;
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
  font-size: 0.3em;
  display: inline;
  margin: 0.5em;
}

h5 {
  margin: 0;
}

#menu-user {
  position: absolute;
  right: 0em;
  top: 103%;
  display: flex;
  justify-content: space-between;
  padding: 0.5em;
  font-size: 1.8em;
  background-color: var(--second-bg-color);
  width: 10%;
  border-bottom: 2px solid black;
  border-left: 2px solid black;
}

@media screen and (min-width: 600px) {
  h1 {
    margin-left: 4em;
    margin-right: 4em;
  }
}
</style>
