<template>
    <div class="container">
        Home
        <form @submit.prevent="addNewBoard">
            <input type="text" placeholder="Создать доску" v-model="title" />

            <div v-for="error of v$.title.$errors" :key="error.$uid">
                <span v-if="error.$validator == 'required'">
                    Введите название доски!
                </span>

                <span v-if="error.$validator == 'maxLength'">
                    Максимальное количество символов: {{ error.$params.max }}
                </span>
            </div>

            <button type="submit">Создать</button>
        </form>

        <div v-for="board in boards" :key="board.id">
            <router-link :to="{ name: 'board', params: { id: board.id } }">
                {{ board.title }}
            </router-link>
            <button @click="deleteBoard(board.id)">Удалить</button>
        </div>
    </div>

    <div v-if="loader">загрузка...</div>
    <div v-if="errored">Ошибка загрузки данных!</div>
</template>

<script>
import useVuelidate from "@vuelidate/core";
import { required, maxLength } from "@vuelidate/validators";

export default {
    name: "TheHome",
    components: {
        // AppBoard,
    },
    data: () => ({
        v$: useVuelidate(),
        boards: [],
        title: null,
        errored: false,
        loader: true,
    }),
    mounted() {
        this.getAllBoards();
    },
    methods: {
        addNewBoard() {
            this.v$.title.$touch();
            if (!this.v$.title.$error) {
                axios
                    .post("/api/boards", {
                        title: this.title,
                    })
                    .then((response) => {
                        this.title = "";
                        this.boards = [];
                        this.getAllBoards();
                    });
            }
        },

        getAllBoards() {
            axios
                .get("/api/boards/")
                .then((response) => {
                    this.boards = response.data.data;
                })
                .catch((error) => {
                    this.errored = true;
                })
                .finally(() => {
                    this.loader = false;
                });
        },

        deleteBoard(id) {
            if (confirm("Удалить доску?")) {
                axios
                    .post(`/api/boards/${id}`, {
                        _method: "DELETE",
                    })
                    .then((response) => {
                        this.boards = [];
                        this.getAllBoards();
                    });
            }
        },
    },
    validations: () => ({
        title: {
            required,
            maxLength: maxLength(255),
        },
    }),
};
</script>
