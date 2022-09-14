<script setup>
import HeaderComp from "./components/Header/HeaderComp.vue";
import FooterComp from "./components/Footer/FooterComp.vue";
import { useUserStore } from "@/store/UserStore.js";
const store = useUserStore();
</script>

<template>
  <div>
    <HeaderComp />
    <router-view></router-view>
    <FooterComp />
  </div>
</template>
