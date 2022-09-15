<template>
  <div class="admin">
    <input type="text" name="" id="" />
    <router-view />
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
  height: 50vh;
  margin-top: 5em;
}
</style>
