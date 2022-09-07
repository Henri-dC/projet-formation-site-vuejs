<template>
  <div>
    <button @click="listAccount">Voir tous les comptes</button>
    <ul v-for="user in users" v-bind:key="user">
      <li>{{ user["login"] }}</li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      users: {},
    };
  },
  methods: {
    async listAccount(e) {
      e.preventDefault();

      let url = new URL("http://localhost:8889/api/index.php");
      url.search = "?route=/account";
      return fetch(url, {
        method: "GET",
      })
        .then((response) => response.json())
        .then((result) => {
          if (result["errors"]) {
            this.formErrors = result["errors"];
          } else {
            this.users = result["data"];
          }
        });
    },
  },
};
</script>
