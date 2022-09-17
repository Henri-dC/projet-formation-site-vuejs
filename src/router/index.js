import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/public/HomeView.vue";
import AdminLayout from "../views/admin/Layout.vue";
import EditView from "../views/public/EditView.vue";


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "home",
      component: HomeView,
    },
    {
      path: "/article/edit/:id",
      name: "edit",
      component: EditView,
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
