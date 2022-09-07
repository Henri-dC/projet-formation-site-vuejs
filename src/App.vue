<script setup>
import HeaderComp from "./components/Header/HeaderComp.vue";
import FooterComp from "./components/Footer/FooterComp.vue";
</script>

<template>
  <div>
    <HeaderComp />
    <router-view></router-view>
    <FooterComp />
  </div>
</template>
