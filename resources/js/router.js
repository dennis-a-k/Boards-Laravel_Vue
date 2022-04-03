import { createRouter, createWebHistory } from "vue-router";
import Home from "./components/views/pages/Home.vue";
import Board from "./components/views/pages/Board.vue";
// import TheCart from "./views/pages/TheCart.vue";
// import TheCheckout from "./views/pages/TheCheckout.vue";
// import TheLogin from "./views/pages/Auth/TheLogin.vue";
// import TheRegister from "./views/pages/Auth/TheRegister.vue";

const routes = [
    {
        path: "/",
        name: "home",
        component: Home,
    },
    {
        path: "/board/:id",
        name: "board",
        component: Board,
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
