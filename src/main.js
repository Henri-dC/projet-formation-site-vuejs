import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
import "./assets/main.scss";
import "./assets/normalize.css";
import "./assets/style/theWelcomeStyle.scss";
import { createPinia } from "pinia";
import { welcomeModale } from "./composables/theWelcomeFunctions";

let cookiesTab = document.cookie;
console.log(cookiesTab);
if (cookiesTab.indexOf("mode") === -1) {
  welcomeModale();
  setTimeout(createMyApplication, 6000);
  document.cookie = "mode=no-modale";
} else {
  createMyApplication();
}

function createMyApplication() {
  const app = createApp(App).use(createPinia());
  app.use(router);
  app.mount("#app");
  console.log("main");
  let theWelcome = document.querySelector("#welcomeModale");
  let body = document.querySelector("body");
  body.removeChild(theWelcome);
}
