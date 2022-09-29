<script setup>
import { useUserStore } from "../../store/UserStore.js";
const userStore = useUserStore();
</script>

<template>
  <div id="container-list-users">
    <table>
      <thead>
        <tr>
          <th>Prénom</th>
          <th>Nom</th>
          <th>Email</th>
          <th>Admin</th>
        </tr>
      </thead>
      <tr
        v-for="(user, key) in users"
        v-bind:key="user.id"
        v-on:keyup.enter="getValue"
      >
        <input
          v-if="users[key].edit"
          id="input-id"
          type="text"
          :value="user['id']"
          ref="id"
        />
        <td v-if="!users[key].edit" @dblclick="inputSwitch(key)">
          {{ user["firstName"] }}
        </td>
        <td v-else>
          <input type="text" :value="user['firstName']" ref="firstName" />
        </td>
        <td v-if="!users[key].edit" @dblclick="inputSwitch(key)">
          {{ user["lastName"] }}
        </td>
        <td v-else>
          <input type="mail" :value="user['lastName']" ref="lastName" />
        </td>
        <td v-if="!users[key].edit" @dblclick="inputSwitch(key)">
          {{ user["email"] }}
        </td>
        <td v-else>
          <input type="mail" :value="user['email']" ref="email" />
        </td>
        <td v-if="!users[key].edit" @dblclick="inputSwitch(key)">
          {{ user["isAdmin"] }}
        </td>
        <td v-else>
          <input type="text" :value="user['isAdmin']" ref="isAdmin" />
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
      userEdit: {},
    };
  },
  mounted() {
    this.userStore.getUsers().then((result) => {
      if (result["errors"]) {
        this.formErrors = result["errors"];
      } else {
        this.users = result["data"];
      }
    });
  },
  methods: {
    inputSwitch(key) {
      for (const [user, i] of Object.entries(this.users)) {
        if (key === parseInt(user)) {
          i.edit = true;
        } else {
          i.edit = false;
        }
      }
    },
    updateUser(user) {
      this.userStore.updateUser(user);
    },
    getValue() {
      if (this.$refs.firstName !== undefined) {
        console.log(this.$refs.firstName[0].value);
        console.log(this.$refs.lastName[0].value);
        console.log(this.$refs.email[0].value);
        console.log(this.$refs.isAdmin[0].value);
      }
      if (this.$refs.firstName !== undefined) {
        let user = new User(
          this.$refs.id[0].value,
          this.$refs.firstName[0].value,
          this.$refs.lastName[0].value,
          this.$refs.isAdmin[0].value,
          this.$refs.email[0].value
        );
        this.userStore.updateUser(user);
        alert("Mise à jour réussie");
      }
    },
  },
};
</script>

<style scoped>
#container-list-users {
  padding-top: 4em;
}

table {
  margin: auto;
  margin-top: 1em;
  margin-bottom: 1em;
  border-collapse: collapse;
  width: 80%;
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
  display: inline-block;
}

#input-id {
  display: none;
}
</style>
