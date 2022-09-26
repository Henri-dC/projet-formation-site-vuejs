<script setup>
    import {useUserStore} from '../store/UserStore'
    const userStore = useUserStore();

</script>

<template>
  <div id="container-list-users">
    <button @click="listAccount">Voir tous les comptes</button>
    <ul v-for="(user,key) in users" v-bind:key="user.id">
      <li v-if="!users[key].edit" @dblclick="inputSwitch(key)"><strong>Nom:</strong> {{ user["firstName"] }} <strong>Prénom:</strong> {{ user["lastName"] }} <strong>Email:</strong> {{user["email"]}}</li>
      <div v-else >
       <input type="text" name="firstName" :value='user["firstName"]'/>
       <input type="text" name="lastName" :value='user["lastName"]'/>
       <input type="mail" name="lastName" :value='user["email"]'/>
       <input type="submit" value="modifier" @click="updateUser"/>
       </div>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      users: {},
      edit:false
    };
  },
  methods: {
    async listAccount(e) {
      e.preventDefault();

    await this.userStore.getUsers()   
        .then((result) => {
          if (result["errors"]) {
            this.formErrors = result["errors"];
          } else {
            this.users = result["data"];
          }
        });
    },
    inputSwitch(key){
      this.users[key].edit=true;
      console.log(this.users[key].edit)
    },
    updateUser(user){
      this.userStore.updateUser(user)
    }
  },
};
</script>

<style>
  #container-list-users{
    border: 1px solid black;
    clear:both;
  }

  input{
    display:inline-block;
  }
</style>