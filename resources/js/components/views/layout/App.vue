<template>
    <Header />

    <main>
        <div>
            <router-view></router-view>
        </div>
    </main>

    <Footer />
</template>

<script>
import Header from "../../Header.vue";
import Footer from "../../Footer.vue";

export default {
    components: {
        Header,
        Footer,
    },
};
</script>
