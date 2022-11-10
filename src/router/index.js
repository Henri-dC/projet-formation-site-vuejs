import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/public/HomeView.vue";
import ArticleView from "../views/public/ArticleView.vue";
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
      path: "/article/:id",
      name: "article",
      component: ArticleView,
    },
    {
      path: "/admin",
      name: "admin",
      beforeEnter: (to, from) => {
        let isAdmin = false;
        let user = JSON.parse(localStorage.getItem("user"));
        if (user["_isAdmin"] === "true") {
          isAdmin = true;
        } else {
          isAdmin = false;
          return { name: "home" };
        }
        return isAdmin;
      },
      component: AdminLayout,
    },
    {
      path: "/:pathMatch(.*)*",
      redirect: "/",
    },
  ],
});

export default router;
