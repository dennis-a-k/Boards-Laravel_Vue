require("./bootstrap");

import { createApp } from "vue";

import App from "./components/views/layout/App.vue";
import PrimeVue from "primevue/config";
import router from "./router";

// компоненты PrimeVue
import Message from "primevue/message";
import Menubar from "primevue/menubar";
import Button from "primevue/button";
import Card from "primevue/card";
import InputText from "primevue/inputtext";
import Checkbox from "primevue/checkbox";
import ScrollPanel from "primevue/scrollpanel";
import ToastService from "primevue/toastservice";
import Toast from "primevue/toast";
import ConfirmationService from "primevue/confirmationservice";
import ConfirmDialog from "primevue/confirmdialog";

import "primevue/resources/themes/saga-blue/theme.css"; //theme
import "primevue/resources/primevue.min.css"; //core css
import "primeicons/primeicons.css"; //icons

const app = createApp({});

app.use(PrimeVue);
app.use(ToastService);
app.use(ConfirmationService);
app.use(router);

app.component("Message", Message);
app.component("App", App);
app.component("Menubar", Menubar);
app.component("Button", Button);
app.component("Card", Card);
app.component("InputText", InputText);
app.component("Checkbox", Checkbox);
app.component("ScrollPanel", ScrollPanel);
app.component("Toast", Toast);
app.component("ConfirmDialog", ConfirmDialog);

app.mount("#app");
