<template>
    <header>
        <app-menubar></app-menubar>
    </header>
</template>

<script>
import AppMenubar from "./menubar/app-menubar.vue";

export default {
    name: "Header",
    components: {
        AppMenubar,
    },
};
</script>
