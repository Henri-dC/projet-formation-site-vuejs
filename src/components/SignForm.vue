<template>
  <div id="overlaye">
    <div id="form-container">
      <h2 v-if="signUpForm">Inscription</h2>
      <h2 v-else>Connexion</h2>
      <i
        @click="$emit('toggleSignForm')"
        class="fa-regular fa-circle-xmark fa-xl"
      ></i>
      <p v-if="!signUpForm">
        Vous n'êtes pas inscrit ? :
        <span id="switch-mode" @click="switchMode">S'inscrire</span>
      </p>
      <p v-if="signUpForm">
        Déjà un compte ? :
        <span id="switch-mode" @click="switchMode">Se connecter</span>
      </p>
      <div class="form-container">
        <span class="success" v-if="isCreated"
          >Votre compte a bien été créé</span
        >
        <form action="#">
          <label v-if="signUpForm" for="inputFirstName"
            >Prénom
            <span class="error">{{ state.formErrors.firstName }}</span>
            <input
              v-if="signUpForm"
              name="formFirstName"
              id="inputFirstName"
              type="text"
              v-model="formData.firstName"
          /></label>

          <label for="inputLastName" v-if="signUpForm"
            >Nom <span class="error">{{ state.formErrors.lastName }}</span>
            <input
              v-if="signUpForm"
              name="formLastName"
              id="inputLastName"
              type="text"
              v-model="formData.lastName"
          /></label>

          <label for="inputMail"
            >Email<span class="error">{{ state.formErrors.email }}</span>
            <input
              name="formMail"
              id="inputMail"
              type="email"
              v-model="formData.email"
          /></label>

          <label for="inputPassword"
            >Mot de passe
            <span class="error">{{ state.formErrors.password }}</span>

            <input
              name="formPassword"
              id="inputPassword"
              type="password"
              v-model="formData.password"
          /></label>

          <!--Boutons submit-->

          <input
            v-if="signUpForm"
            type="submit"
            name="accountSubmit"
            value="S'inscrire"
            @click="sendForm"
          />

          <input
            v-else
            type="submit"
            name="accountSubmit"
            value="Se connecter"
            @click="sendForm"
          />
          <span id="error-account">{{ state.formErrors.account }}</span>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useUserStore } from "@/store/UserStore.js";
import { ref, reactive } from "vue";
import { fetchData } from "../composables/useFetch.js";
import { User } from "../composables/userClass.js";
let signUpForm = ref(false); //Allow switching between signUp and signIn form
let isCreated = ref(false); //Allow confirmation text after successfull registration
let state = reactive({ formErrors: {} }); //Allows errors messages
let formData = ref({}); //Registration of input contents
let current_user = ref({}); //Informations about user after connexion
let userStore = useUserStore();
let emit = defineEmits(["toggleSignForm", "user"]);

function switchMode() {
  signUpForm.value = !signUpForm.value;
  state.formErrors = {};
}

function checkForm(mode) {
  let errors = [];
  if (!formData.value.email) {
    state.formErrors.email = "Veuillez renseigner votre email";
    errors.push("email");
  }
  if (!formData.value.password) {
    state.formErrors.password = "Veuillez renseigner votre mot de passe";
    errors.push("password");
  }
  if (mode === "signUp") {
    if (!formData.value.firstName) {
      state.formErrors.firstName = "Veuillez renseigner votre prénom";
      errors.push("firstName");
    }
    if (!formData.value.lastName) {
      state.formErrors.lastName = "Veuillez renseigner votre nom";
      errors.push("lastName");
    }
  }
  return errors.length === 0 ? true : false;
}

function sendForm(event) {
  event.preventDefault();

  state.formErrors = {};

  //FORMULAIRE D'INSCRIPTION

  if (signUpForm.value) {
    if (checkForm("signUp")) {
      let request = new fetchData("POST", "?route=/account", formData.value);
      request.query().then((result) => {
        if (result["errors"]) {
          state.formErrors = result["errors"];
        } else {
          formData.value = {};
          isCreated.value = true;
          setTimeout(() => {
            isCreated.value = false;
          }, 2000);
        }
      });
    }
  } else {
    //FORMULAIRE DE CONNEXION

    if (checkForm()) {
      let request = new fetchData("POST", "?route=/login", formData.value);
      request.query().then((result) => {
        if (result["errors"]) {
          state.formErrors = result["errors"];
        } else {
          current_user.value = new User(
            result["data"]["id"],
            result["data"]["firstName"],
            result["data"]["lastName"],
            result["data"]["is_admin"]
          );
          //Information about user are stored in localstorage an redirection
          localStorage.setItem("user", JSON.stringify(current_user.value));
          localStorage.setItem("welcome-modale", 0);
          window.location = "http://localhost:5173/";
        }
      });
    }
  }
}
</script>

<style lang="sass" scoped>
@import '../assets/style/SignForm.scss'
</style>
