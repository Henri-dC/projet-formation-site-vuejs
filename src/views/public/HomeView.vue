<template>
  <main>
    <Transition>
      <PopUPModale
        v-if="ServiceStore.displayModaleText"
        :msg="ServiceStore.modaleText"
      />
    </Transition>
    <MainComp id="main" />
  </main>
</template>

<script setup>
import MainComp from "../../components/MainComp.vue";
import PopUPModale from "../../components/PopUPModale.vue";
import { useServiceStore } from "../../store/ServiceStore.js";
import { useUserStore } from "../../store/UserStore.js";
import { useLikesStore } from "../../store/LikesStore.js";
import { ref, onMounted } from "vue";
const ServiceStore = useServiceStore();
const LikesStore = useLikesStore();
const User = useUserStore();
const displayModale = ref(ServiceStore.displayModaleText);
let display = ref(ServiceStore.displayModaleText);

function darkMode() {
  let articles = document.querySelectorAll(".article-container");
  articles.forEach((element) => {
    element.style.backgroundColor = "#666";
  });
}

onMounted(() => {
  if (localStorage["welcome-modale"] === "0") {
    ServiceStore.modaleText = "Bienvenue " + User.user._firstName + " !";
    ServiceStore.displayModaleText = true;
    localStorage["welcome-modale"] = 1;
  }
  if (localStorage["user"]) {
    LikesStore.getLikesByUser(User.user._id);
  }
});
</script>

<style scoped>
button {
  position: absolute;
  z-index: 500;
}
</style>
