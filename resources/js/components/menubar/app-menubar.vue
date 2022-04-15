<template>
    <Menubar>
        <template #start>
            <router-link :to="{ name: 'home' }">
                <Button
                    label="Доски"
                    icon="pi pi-fw pi-stop"
                    class="p-button-text p-button-plain"
                />
            </router-link>
        </template>
    </Menubar>
</template>

<script>
export default {
    name: "app-menubar",
    data: () => ({}),
};
</script>
