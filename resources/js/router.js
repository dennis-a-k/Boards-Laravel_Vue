import { createRouter, createWebHistory } from "vue-router";
import Home from "./components/views/pages/Home.vue";
import Board from "./components/views/pages/Board.vue";

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
];

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes,
});

export default router;
