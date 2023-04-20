/* Import bootstrap laravel*/
require("./bootstrap");

/* Import Vue */
import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";

/* Create Vue app */
const app = createApp(App);
app.use(router);
app.mount("#app");
