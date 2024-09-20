import { createRouter, createWebHistory } from "vue-router";
import Home from "./pages/Home.vue";
import RestaurantDetail from "./pages/RestaurantDetail.vue";
import Cashout from "./pages/Cashout.vue";
import NotFound from "./pages/NotFound.vue";

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: "/",
      name: "home",
      component: Home,
    },
    {
      path: "/restaurant/:id",
      name: "RestaurantDetail",
      component: RestaurantDetail,
    },
    {
      path: "/cashout/",
      name: "cashout",
      component: Cashout,
    },
    {
      path: "/:pathMatch(.*)*",
      name: "NotFound",
      component: NotFound,
    },
  ],
});
export { router };
