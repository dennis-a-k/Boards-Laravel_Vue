<template>
    <footer class="py-3 text-end">Доски © {{ date }}</footer>
</template>

<script>
export default {
    name: "Footer",
    data: () => ({
        date: new Date().getFullYear(),
    }),
};
</script>
