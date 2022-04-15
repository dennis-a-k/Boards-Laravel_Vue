require("./bootstrap");

import { createApp } from "vue";

import App from "./components/views/layout/App.vue";
import PrimeVue from "primevue/config";
import router from "./router";

// компоненты PrimeVue
import Menubar from "primevue/menubar";
import Button from "primevue/button";
import Card from "primevue/card";
import InputText from "primevue/inputtext";
import ToastService from "primevue/toastservice";

import "primevue/resources/themes/saga-blue/theme.css"; //theme
import "primevue/resources/primevue.min.css"; //core css
import "primeicons/primeicons.css"; //icons

const app = createApp({});

app.use(PrimeVue);
app.use(router);

app.component("App", App);
app.component("Menubar", Menubar);
app.component("Button", Button);
app.component("Card", Card);
app.component("InputText", InputText);
app.component("ToastService", ToastService);

app.mount("#app");
