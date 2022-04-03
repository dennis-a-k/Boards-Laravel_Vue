<template>
    <router-link :to="{ name: 'home' }">Доски</router-link>

    <div v-if="loader">загрузка...</div>

    <div v-else>
        <input type="text" @blur="saveTitle" v-model="title" />

        <div v-for="error of v$.title.$errors" :key="error.$uid">
            <span v-if="error.$validator == 'required'">
                Введите название доски!
            </span>

            <span v-if="error.$validator == 'maxLength'">
                Максимальное количество символов: {{ error.$params.max }}
            </span>
        </div>

        <div v-for="list in lists" :key="list.id">
            <router-link :to="{ name: 'board', params: { id: list.id } }">
                {{ list.title }}
            </router-link>
            <input
                type="text"
                @blur="updateTitleList(list.id, list.title)"
                v-model="list.title"
            />

            <button @click="deleteList(list.id)">Удалить</button>
        </div>

        <form @submit.prevent="addNewList">
            <input
                type="text"
                placeholder="Создать список"
                v-model="title_list"
            />

            <div v-for="error of v$.title_list.$errors" :key="error.$uid">
                <span v-if="error.$validator == 'required'">
                    Введите название списка!
                </span>

                <span v-if="error.$validator == 'maxLength'">
                    Максимальное количество символов: {{ error.$params.max }}
                </span>
            </div>

            <button type="submit">Создать</button>
        </form>
    </div>

    <div v-if="errored">Ошибка загрузки данных!</div>
</template>

<script>
import useVuelidate from "@vuelidate/core";
import { required, maxLength } from "@vuelidate/validators";
// import AppBreadcrump from "../../components/breadcrumb/app-breadcrumb.vue";
// import AppCardProduct from "../../components/cards/app-card-product.vue";
// import AppSliderGoods from "../../components/sliders/app-slider-goods.vue";
// import AppModalReview from "../../components/modals/app-modal-review.vue";
// import { mapActions, mapGetters } from "vuex";

export default {
    name: "TheBoard",
    components: {
        // AppBoard,
    },
    props: {
        id: {
            type: String,
        },
    },
    data: () => ({
        v$: useVuelidate(),
        lists: [],
        title: null,
        title_list: null,
        errored: false,
        loader: true,
    }),
    mounted() {
        this.getAllLists();
    },
    methods: {
        addNewList() {
            this.v$.title_list.$touch();
            if (!this.v$.title_list.$error) {
                axios
                    .post("/api/board-lists", {
                        title: this.title_list,
                        board_id: this.id,
                    })
                    .then((response) => {
                        this.title_list = "";
                        this.lists = [];
                        this.getAllLists();
                    });
            }
        },

        deleteList(id) {
            if (confirm("Удалить список?")) {
                axios
                    .post(`/api/board-lists/${id}`, {
                        _method: "DELETE",
                    })
                    .then((response) => {
                        this.lists = [];
                        this.getAllLists();
                    });
            }
        },

        getAllLists() {
            axios
                .get(`/api/boards/${this.id}`)
                .then((response) => {
                    this.title = response.data.data.title;
                    this.lists = response.data.data.lists;
                })
                .catch((error) => {
                    this.errored = true;
                })
                .finally(() => {
                    this.loader = false;
                });
        },

        saveTitle() {
            this.v$.title.$touch();
            if (!this.v$.title.$error) {
                axios.post(`/api/boards/${this.id}`, {
                    _method: "PUT",
                    title: this.title,
                });
            }
        },

        updateTitleList(id, title) {
            this.v$.title_list.$touch();
            if (!this.v$.title_list.$error) {
                axios.post(`/api/board-lists/${id}`, {
                    _method: "PUT",
                    title: title,
                    board_id: this.id,
                });
            }
        },
    },
    validations: () => ({
        title: {
            required,
            maxLength: maxLength(255),
        },
        title_list: {
            required,
            maxLength: maxLength(255),
        },
    }),
};
</script>
