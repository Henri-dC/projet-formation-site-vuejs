<template>
  <div id="dark-mode-toggle">
    <label @click="$emit('emitValue', test)" class="switch">
      <input type="checkbox" v-model="test" />
      <span></span>
    </label>
  </div>
</template>

<script setup>
import { ref } from "vue";
let test = ref(false);
</script>

<style>
.switch {
  display: inline-block;
  position: relative;
  width: 35px;
  height: 20px;
  cursor: pointer;
  overflow: hidden;
}

.switch input {
  position: absolute;
  top: -15px;
  left: -15px;
  width: 0;
  height: 0;
}

.switch input + span {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background: var(--third-bg-color);
  border-radius: 10px;
}

.switch input:checked + span {
  background: var(--second-bg-color);
}

.switch input + span:before {
  content: "";
  display: inline-block;
  position: absolute;
  top: 50%;
  left: 2px;
  width: 16px;
  height: 16px;
  background: white;
  border-radius: 50%;
  transform: translateY(-50%);
  transition: all 0.5s;
  background: var(--main-bg-color);
}

.switch input:checked + span:before {
  left: 17px;
}
</style>
