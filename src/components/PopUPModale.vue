<template>
  <div id="modale">
    <div id="border-div">
      <p id="modale-msg">{{ msg }}</p>
    </div>
  </div>
</template>

<script setup>
import { useServiceStore } from "../store/ServiceStore.js";
import { watch } from "vue";
const ServiceStore = useServiceStore();
let props = defineProps(["msg"]);
</script>

<style lang="scss">
#modale {
  position: fixed;
  left: 50%;
  background-color: grey;
  padding: 0.2em 5em;
  transform: translate(-50%, -50%);
  z-index: 900;
  border-radius: 10px;
}
#border-div {
  border: 1px solid white;
  border-radius: 10px;
  padding: 0 1em;
}
#modale-msg {
  font-size: 2em;
  text-align: center;
  color: white;
  margin: 0;
}

.v-enter-active {
  transition: all 1s;
}
.v-leave-active {
  transition: all 1.5s cubic-bezier(1, 1, 1, 1);
}

.v-enter-from {
  transform: translateX(500px);
  opacity: 0;
}
.v-leave-to {
  transform: translateX(500px);
  opacity: 0;
}
</style>
