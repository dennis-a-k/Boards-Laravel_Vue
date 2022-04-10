<template>
    <router-link :to="{ name: 'home' }">Доски</router-link>

    <div v-for="error of v$.cards.$errors" :key="error.$uid">
        <span v-if="error.$validator == 'required'">
            Введите название карточки!
        </span>

        <!-- <span v-if="error.$validator == 'maxLength'">
            Максимальное количество символов:
            {{ error.$params.max }}
        </span> -->
    </div>

    <div v-if="loader">загрузка...</div>

    <div v-else>
        <form v-if="board_id == this.id" @submit.prevent="updateTitle">
            <input type="text" @blur="updateTitle" v-model="title" />
            <button type="button" @click="board_id = null">close</button>
        </form>
        <h2 v-else @click="board_id = this.id">
            {{ title }}
        </h2>

        <div v-for="error of v$.title.$errors" :key="error.$uid">
            <span v-if="error.$validator == 'required'">
                Введите название доски!
            </span>

            <span v-if="error.$validator == 'maxLength'">
                Максимальное количество символов: {{ error.$params.max }}
            </span>
        </div>

        <div v-for="list in lists" :key="list.id">
            <form
                v-if="list_id == list.id"
                @submit.prevent="updateTitleList(list.id, list.title)"
            >
                <input
                    type="text"
                    @blur="updateTitleList(list.id, list.title)"
                    v-model="list.title"
                />
                <button type="button" @click="list_id = null">close</button>
            </form>
            <h3 v-else @click="list_id = list.id">
                {{ list.title }}
            </h3>

            <button @click="deleteList(list.id)">Удалить</button>

            <div v-for="card in list.cards" :key="card.id">
                {{ card.title }}
                <button @click="deleteCard(card.id)">Удалить</button>
            </div>

            <form @submit.prevent="addNewCard(list.id)">
                <input
                    type="text"
                    placeholder="Создать карточку"
                    maxlength="255"
                    v-model="cards[list.id]"
                />
            </form>
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

export default {
    name: "Board",
    props: {
        id: {
            type: String,
        },
    },
    data: () => ({
        v$: useVuelidate(),
        lists: [],
        cards: [],
        title: null,
        title_list: null,
        board_id: null,
        list_id: null,
        errored: false,
        loader: true,
    }),
    mounted() {
        this.getAllLists();
    },
    methods: {
        addNewCard(id) {
            this.v$.cards.$touch();
            if (!this.v$.cards.$error) {
                axios
                    .post("/api/cards", {
                        title: this.cards[id],
                        board_list_id: id,
                    })
                    .then((response) => {
                        this.v$.$reset();
                        this.cards = [];
                        this.getAllLists();
                    });
            }
        },

        addNewList() {
            this.v$.title_list.$touch();
            if (!this.v$.title_list.$error) {
                axios
                    .post("/api/board-lists", {
                        title: this.title_list,
                        board_id: this.id,
                    })
                    .then((response) => {
                        this.v$.$reset();
                        this.title_list = "";
                        this.lists = [];
                        this.getAllLists();
                    });
            }
        },

        deleteCard(id) {
            if (confirm("Удалить карточку?")) {
                axios
                    .post(`/api/cards/${id}`, {
                        _method: "DELETE",
                    })
                    .then((response) => {
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

        updateTitle() {
            this.v$.title.$touch();
            if (!this.v$.title.$error) {
                axios
                    .post(`/api/boards/${this.id}`, {
                        _method: "PUT",
                        title: this.title,
                    })
                    .then((response) => {
                        this.board_id = null;
                    });
            }
        },

        updateTitleList(id, title) {
            axios
                .post(`/api/board-lists/${id}`, {
                    _method: "PUT",
                    title: title,
                    board_id: this.id,
                })
                .then((response) => {
                    this.list_id = null;
                });
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
        cards: {
            required,
            // maxLength: maxLength(5),
        },
    }),
};
</script>

<style scoped>
h3 {
    cursor: pointer;
}
</style>
