<script setup>
import { useUserStore } from "../store/UserStore";
const userStore = useUserStore();
</script>

<template>
  <div id="container-list-users">
    <button @click="listAccount">Voir tous les comptes</button>
    <table>
      <thead>
        <tr>
          <th>Prénom</th>
          <th>Nom</th>
          <th>Email</th>
        </tr>
      </thead>
      <tr v-for="(user, key) in users" v-bind:key="user.id">
        <td v-if="!users[key].edit" @dblclick="inputSwitch(key)">
          {{ user["firstName"] }}
        </td>
        <td v-else>
          <input type="text" name="firstName" :value="user['firstName']" />
        </td>
        <td v-if="!users[key].edit" @dblclick="inputSwitch(key)">
          {{ user["lastName"] }}
        </td>
        <td v-else>
          <input type="mail" name="lastName" :value="user['lastName']" />
        </td>
        <td v-if="!users[key].edit" @dblclick="inputSwitch(key)">
          {{ user["email"] }}
        </td>
        <td v-else>
          <input type="mail" name="lastName" :value="user['email']" />
        </td>
      </tr>
    </table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      users: {},
      edit: false,
    };
  },
  methods: {
    async listAccount(e) {
      e.preventDefault();

      await this.userStore.getUsers().then((result) => {
        if (result["errors"]) {
          this.formErrors = result["errors"];
        } else {
          this.users = result["data"];
        }
      });
    },
    inputSwitch(key) {
      this.users[key].edit = true;
      console.log(this.users[key].edit);
    },
    updateUser(user) {
      this.userStore.updateUser(user);
    },
  },
};
</script>

<style>
#container-list-users {
  border: 1px solid black;
  clear: both;
}

table {
  margin: auto;
  margin-top: 1em;
  margin-bottom: 1em;
  border-collapse: collapse;
}

td {
  border: 1px solid;
  padding: 1.2em 0em;
  background-color: white;
  width: 10%;
}

input {
  border: none;
  text-align: center;
}

input {
  display: inline-block;
}
</style>
