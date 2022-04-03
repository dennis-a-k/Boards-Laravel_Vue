require("./bootstrap");

import { createApp } from "vue";

import App from "./components/views/layout/App.vue";
import PrimeVue from "primevue/config";
import router from "./router";

// компоненты PrimeVue
import Button from "primevue/button";
import ToastService from "primevue/toastservice";

import "primevue/resources/themes/saga-blue/theme.css"; //theme
import "primevue/resources/primevue.min.css"; //core css
import "primeicons/primeicons.css"; //icons

const app = createApp({});

app.use(PrimeVue);
app.use(router);

app.component("App", App);
app.component("Button", Button);
app.component("ToastService", ToastService);

app.mount("#app");
