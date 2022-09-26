<script setup>
import TheHeader from "./components/Header/TheHeader.vue";
import TheFooter from "./components/Footer/TheFooter.vue";
import { useUserStore } from "@/store/UserStore.js";
const store = useUserStore();
</script>

<template>
  <div>
    <TheHeader />
    <router-view></router-view>
    <TheFooter/>
  </div>
</template>
