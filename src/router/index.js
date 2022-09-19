import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/public/HomeView.vue";
import AdminLayout from "../views/admin/Layout.vue";



const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "home",
      component: HomeView,
    },
    {
      path: "/admin",
      name: "admin",
      component: AdminLayout,
    },
    /*{
      path: "/:pathMatch(.*)*",
      redirect: "/",
    },*/
  ],
});

export default router;
