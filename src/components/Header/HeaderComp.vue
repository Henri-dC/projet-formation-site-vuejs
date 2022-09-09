<script setup>
import SignForm from "./SignForm.vue";
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
      <li @click="toggleSignForm"><i class="fa-solid fa-user"></i></li>
    </ul>
    <SignForm v-if="this.signForm" @toggle-sign-form="toggleSignForm" />
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
  margin-left: 4em;
  margin-right: 4em;
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
</style>
