import { createRouter, createWebHistory } from "vue-router";
import TheHome from "./components/views/pages/TheHome.vue";
import TheBoard from "./components/views/pages/TheBoard.vue";
// import TheCart from "./views/pages/TheCart.vue";
// import TheCheckout from "./views/pages/TheCheckout.vue";
// import TheLogin from "./views/pages/Auth/TheLogin.vue";
// import TheRegister from "./views/pages/Auth/TheRegister.vue";

const routes = [
    {
        path: "/",
        name: "home",
        component: TheHome,
    },
    {
        path: "/board/:id",
        name: "board",
        component: TheBoard,
        props: true,
    },
    // {
    //     path: "/cart",
    //     name: "cart",
    //     component: TheCart,
    // },
    // {
    //     path: "/checkout",
    //     name: "checkout",
    //     component: TheCheckout,
    // },
    // {
    //     path: "/login",
    //     name: "login",
    //     component: TheLogin,
    // },
    // {
    //     path: "/register",
    //     name: "register",
    //     component: TheRegister,
    // },
];

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes,
});

export default router;
