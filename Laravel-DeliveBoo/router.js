import { createRouter, createWebHistory } from "vue-router";
import Home from "./pages/Home.vue";
import AboutUs from "./pages/AboutUs.vue";
import Contacts from "./pages/Contacts.vue";
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
      path: "/about",
      name: "about",
      component: AboutUs,
    },
    {
      path: "/contacts",
      name: "contacts",
      component: Contacts,
    },
    {
      path: "/:pathMatch(.*)*",
      name: "NotFound",
      component: NotFound,
    },
  ],
});
export { router };
