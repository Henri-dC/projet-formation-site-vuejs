<script setup>
import ListAccount from "../../components/ListAccount.vue";
import AddCategoryButton from "../../components/Admin/AddCategoryButton.vue";
</script>

<template>
  <div class="admin">
    <AddCategoryButton/>
    <ListAccount/>
    <router-link to="/admin/articles" tag="button">Gérer les articles</router-link>
  </div>
</template>

<script>
export default {
  name: "AdminLayout",
};
</script>

<style scoped>
.admin {
  background-color: aqua;
  height: 70vh;
  margin-top: 5em;
  text-align:center;
}
</style>
