import "font-awesome/css/font-awesome.min.css";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.bundle.min.js";
import { createApp } from "vue";
// import main sass
import "./assets/scss/main.scss";
import App from "./App.vue";
// import router
import { router } from "./router";

createApp(App).use(router).mount("#app");
