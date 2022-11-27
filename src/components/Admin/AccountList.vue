<template>
  <div id="container-list-users">
    <h2>Liste des utilisateurs</h2>
    <table>
      <thead>
        <tr>
          <th>Prénom</th>
          <th>Nom</th>
          <th>Email</th>
          <th>Admin</th>
          <th>Supprimer</th>
        </tr>
      </thead>
      <tr
        v-for="(user, key) in users"
        :key="user.id"
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
        <td>
          <div class="icon" @click="deleteUser(user['id'])">
            <img
              src="../../assets/images/icon/delete_FILL0_wght400_GRAD0_opsz48.svg"
            />
          </div>
        </td>
      </tr>
    </table>
  </div>
</template>

<script setup>
import { useUserStore } from "../../store/UserStore.js";
import { User } from "../../composables/userClass.js";
import { useServiceStore } from "../../store/ServiceStore.js";
import { useLikesStore } from "../../store/LikesStore.js";
import { ref, onMounted } from "vue";
const ServiceStore = useServiceStore();
const LikesStore = useLikesStore();
const userStore = useUserStore();
let users = ref({});
let userEdit = ref({});
let formErrors = ref({});
let id = ref();
let firstName = ref();
let lastName = ref();
let email = ref();
let isAdmin = ref();

onMounted(() => {
  userStore.getUsers().then((result) => {
    if (result["errors"]) {
      formErrors.value = result["errors"];
    } else {
      users.value = result["data"];
    }
  });
});
function inputSwitch(key) {
  for (const [index, user] of Object.entries(users.value)) {
    if (key === parseInt(index)) {
      user.edit = true;
    } else {
      user.edit = false;
    }
  }
}

function updateUser(user) {
  userStore.updateUser(user);
}

function deleteUser(id) {
  LikesStore.deleteLikesByUser(id);
  userStore.deleteUser(id);
  userStore.getUsers();
}

function getValue() {
  if (firstName.value !== undefined) {
    let user = new User(
      id.value[0].value,
      firstName.value[0].value,
      lastName.value[0].value,
      isAdmin.value[0].value,
      email.value[0].value
    );
    userStore.updateUser(user);
    ServiceStore.modaleText = "Modifications enregistrées";
    ServiceStore.displayModaleText = true;
  }
}
</script>

<style scoped>
@import "../../assets/style/Admin/AccountList.scss";
</style>
