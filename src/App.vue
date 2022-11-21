<template>
  <div id="main-container">
    <TheHeader />
    <router-view></router-view>
    <TheFooter />
  </div>
</template>

<script setup>
import TheHeader from "./components/TheHeader.vue";
import TheFooter from "./components/TheFooter.vue";
import { useUserStore } from "@/store/UserStore.js";
const store = useUserStore();
</script>
