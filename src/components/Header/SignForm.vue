<template>
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
      <span class="success" v-if="isCreated">Votre compte a bien été créé</span>
      <form action="#">
        <label v-if="signUpForm" for="inputFirstName"
          >Prénom <span class="error">{{ formErrors.firstName }}</span></label
        >
        <input
          v-if="signUpForm"
          name="formFirstName"
          id="inputFirstName"
          type="text"
          v-model="formData.firstName"
        />

        <label for="inputLastName" v-if="signUpForm"
          >Nom <span class="error">{{ formErrors.lastName }}</span></label
        >
        <input
          v-if="signUpForm"
          name="formLastName"
          id="inputLastName"
          type="text"
          v-model="formData.lastName"
        />

        <label for="inputLogin"
          >Login <span class="error">{{ formErrors.login }}</span></label
        >
        <input
          name="formLogin"
          id="inputLogin"
          type="text"
          v-model="formData.login"
        />

        <label for="inputPassword"
          >Mot de passe
          <span class="error">{{ formErrors.password }}</span></label
        >
        <input
          name="formPassword"
          id="inputPassword"
          type="password"
          v-model="formData.password"
        />

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
        <span id="error-account">{{ formErrors.account }}</span>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  emits: ["toggleSignForm", "user"],
  data() {
    return {
      signUpForm: false,
      isCreated: false,
      formErrors: {},
      formData: {},
      current_user: {},
    };
  },
  methods: {
    switchMode() {
      this.signUpForm = !this.signUpForm;
      this.formErrors = {};
    },
    async sendForm(event) {
      event.preventDefault();
      let url = new URL("http://localhost:8889/api/index.php");

      this.formErrors = {};

      if (this.signUpForm) {
        url.search = "?route=/account";

        return fetch(url, {
          method: "POST",
          mode: "cors",
          credentials: "include",
          header: {
            "Content-Type": "application/json; charset=UTF-8",
          },
          body: JSON.stringify(this.formData),
        })
          .then((response) => response.json())
          .then((result) => {
            if (result["errors"]) {
              this.formErrors = result["errors"];
            } else {
              this.formErrors = {};
              this.formData = {};
              this.isCreated = true;
            }
          });
      } else {
        url.search = "?route=/login";

        return fetch(url, {
          method: "POST",
          mode: "cors",
          credentials: "include",
          header: {
            "Content-Type": "application/json; charset=UTF-8",
          },
          body: JSON.stringify(this.formData),
        })
          .then((response) => response.json())
          .then((result) => {
            if (result["errors"]) {
              this.formErrors = result["errors"];
              console.log(this.formErrors);
            } else {
              this.current_user = new User(
                result["data"]["id"],
                result["data"]["firstName"],
                result["data"]["lastName"]
              );
            }
          });
      }
    },
  },
};
</script>

<style scoped>
/* ********************* GENERAL ************************/

#form-container {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -90%);
  width: 80%;
  border-radius: 2em;
  padding: 2em;
  background-color: aliceblue;
  z-index: 1000;
  border: 1px solid black;
}

p {
  text-align: center;
}
h1,
h2 {
  text-align: center;
}
#switch-mode {
  cursor: pointer;
}
form {
  display: flex;
  flex-direction: column;
  margin: auto;
}
label {
  font-size: 1.2em;
}

input {
  margin-bottom: 1em;
  width: 100%;
}

span {
  color: red;
}
#error-account {
  text-align: center;
}

.error {
  font-size: 0.8em;
}

.fa-regular {
  position: absolute;
  top: 1.5em;
  right: 1.5em;
  cursor: pointer;
}

.fa-regular:hover {
  color: var(--main-bg-color);
}

@media screen and (min-width: 900px) {
  #form-container {
    width: 30%;
  }
}
</style>
