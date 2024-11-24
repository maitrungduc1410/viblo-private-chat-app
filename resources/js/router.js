import { createWebHistory, createRouter } from "vue-router";

import ListRoom from "./pages/ListRoom.vue";
import Room from "./pages/Room.vue";

const routes = [
    {
        path: "/",
        name: "list.room",
        component: ListRoom,
    },
    {
        path: "/rooms/:roomId",
        name: "room",
        component: Room,
    },
];

export const router = createRouter({
    history: createWebHistory(),
    routes,
});
