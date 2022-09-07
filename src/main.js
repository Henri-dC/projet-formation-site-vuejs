import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";

import "./assets/main.css";
import "./assets/normalize.css";

const app = createApp(App);
app.use(router);
app.mount("#app");

import { getCurrentInstance } from "vue";
export default {
  setup() {
    // accessible inside setup function
    const instance = getCurrentInstance();
    console.log(instance);
  },
};
