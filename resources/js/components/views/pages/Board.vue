<template>
    <!-- <div v-for="error of v$.cards.$errors" :key="error.$uid">
        <span v-if="error.$validator == 'required'">
            Введите название карточки!
        </span>

        <span v-if="error.$validator == 'maxLength'">
            Максимальное количество символов:
            {{ error.$params.max }}
        </span>
    </div> -->
    <Toast />
    <div v-if="loader" class="text-center my-3"><h4>загрузка...</h4></div>

    <div v-else>
        <div class="my-4">
            <form v-if="board_id == this.id" @submit.prevent="updateTitle">
                <div class="grid p-fluid">
                    <div class="col-md-8 col-lg-6">
                        <div class="p-inputgroup">
                            <InputText
                                :class="{ 'p-invalid': v$.title.$error }"
                                type="text"
                                @blur="updateTitle"
                                v-model="title"
                            />
                            <Button
                                icon="pi pi-check"
                                class="p-button-success"
                                type="button"
                                @click="board_id = null"
                            />
                        </div>

                        <div
                            v-for="error of v$.title.$errors"
                            :key="error.$uid"
                            class="text-center"
                        >
                            <span v-if="error.$validator == 'required'">
                                <small class="p-error"
                                    >Введите название доски!</small
                                >
                            </span>

                            <span v-if="error.$validator == 'maxLength'">
                                <small class="p-error">
                                    Максимальное количество символов:
                                    {{ error.$params.max }}
                                </small>
                            </span>
                        </div>
                    </div>
                </div>
            </form>

            <h2 v-else @click="board_id = this.id">
                {{ title }}
            </h2>
        </div>

        <div class="row">
            <div
                v-for="list in lists"
                :key="list.id"
                class="col-md-6 col-lg-4 col-xl-3 mb-3"
            >
                <Card>
                    <template #header>
                        <div class="d-flex justify-content-end">
                            <Button
                                class="p-button p-component p-button-icon-only p-button-rounded p-button-danger p-button-text"
                                @click="deleteList(list.id)"
                            >
                                <span class="pi pi-trash p-button-icon"></span>
                            </Button>
                        </div>
                    </template>

                    <template #subtitle>
                        <form
                            v-if="list_id == list.id"
                            @submit.prevent="
                                updateTitleList(list.id, list.title)
                            "
                        >
                            <div class="grid p-fluid">
                                <div class="p-inputgroup">
                                    <InputText
                                        type="text"
                                        @blur="
                                            updateTitleList(list.id, list.title)
                                        "
                                        v-model="list.title"
                                    />
                                    <Button
                                        icon="pi pi-times"
                                        class="p-button-danger"
                                        type="button"
                                        @click="list_id = null"
                                    />
                                </div>
                            </div>
                        </form>

                        <h3 v-else @click="list_id = list.id">
                            {{ list.title }}
                        </h3>
                    </template>

                    <template #content>
                        <div
                            class="card-title"
                            v-for="card in list.cards"
                            :key="card.id"
                            @click="getCard(card.id)"
                        >
                            <Card
                                data-bs-toggle="modal"
                                :data-bs-target="'#modal' + card.id"
                            >
                                <template #content>
                                    {{ card.title }}
                                </template>
                            </Card>

                            <!-- Modal -->
                            <div
                                class="modal fade"
                                :id="'modal' + card.id"
                                tabindex="-1"
                                aria-labelledby="exampleModalLabel"
                                aria-hidden="true"
                            >
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="col-10">
                                                <form
                                                    v-if="card_id == card.id"
                                                    @submit.prevent="
                                                        updateTitleCard(
                                                            card.id,
                                                            card.title
                                                        )
                                                    "
                                                >
                                                    <div class="grid p-fluid">
                                                        <div
                                                            class="p-inputgroup"
                                                        >
                                                            <InputText
                                                                :class="{
                                                                    'p-invalid':
                                                                        v$.card
                                                                            .title
                                                                            .$error,
                                                                }"
                                                                type="text"
                                                                @blur="
                                                                    updateTitleCard(
                                                                        card.id,
                                                                        card.title
                                                                    )
                                                                "
                                                                v-model="
                                                                    card.title
                                                                "
                                                                required
                                                                maxlength="255"
                                                            />
                                                            <Button
                                                                icon="pi pi-check"
                                                                class="p-button-success"
                                                                type="button"
                                                                @click="
                                                                    card_id =
                                                                        null
                                                                "
                                                            />
                                                        </div>
                                                    </div>
                                                </form>

                                                <h3
                                                    v-else
                                                    @click="card_id = card.id"
                                                >
                                                    {{ card.title }}
                                                </h3>
                                            </div>
                                            <div
                                                class="d-flex justify-content-end"
                                            >
                                                <Button
                                                    class="p-button p-component p-button-icon-only p-button-rounded p-button-danger p-button-text"
                                                    @click="deleteCard(card.id)"
                                                    type="button"
                                                    data-bs-dismiss="modal"
                                                    aria-label="Close"
                                                >
                                                    <span
                                                        class="pi pi-trash p-button-icon"
                                                    ></span>
                                                </Button>
                                            </div>
                                        </div>
                                        <div class="modal-body">
                                            <p>{{ card.id }}</p>
                                            <p>{{ card.title }}</p>
                                            <p>{{ card.board_list_id }}</p>
                                        </div>
                                    </div>
                                </div>

                                <ConfirmDialog />
                            </div>
                        </div>
                    </template>

                    <template #footer>
                        <form @submit.prevent="addNewCard(list.id)">
                            <div class="grid p-fluid">
                                <div class="p-inputgroup">
                                    <span class="p-float-label">
                                        <InputText
                                            id="card"
                                            type="text"
                                            maxlength="255"
                                            v-model="cards[list.id]"
                                        />
                                        <label for="card">
                                            Создать карточку
                                        </label>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </template>
                </Card>
            </div>
            <div class="col-md-6 col-lg-4 col-xl-3">
                <Card>
                    <template #content>
                        <form @submit.prevent="addNewList">
                            <div class="grid p-fluid">
                                <div class="p-inputgroup">
                                    <span class="p-float-label">
                                        <InputText
                                            :class="{
                                                'p-invalid':
                                                    v$.title_list.$error,
                                            }"
                                            id="title_list"
                                            type="text"
                                            v-model="title_list"
                                        />
                                        <label for="title_list">
                                            Создать список
                                        </label>
                                    </span>
                                </div>
                            </div>

                            <div
                                class="text-center"
                                v-for="error of v$.title_list.$errors"
                                :key="error.$uid"
                            >
                                <span v-if="error.$validator == 'required'">
                                    <small class="p-error">
                                        Введите название списка!
                                    </small>
                                </span>

                                <span v-if="error.$validator == 'maxLength'">
                                    <small class="p-error">
                                        Максимальное количество символов:
                                        {{ error.$params.max }}
                                    </small>
                                </span>
                            </div>
                        </form>
                    </template>
                </Card>
            </div>
            l>
        </div>
    </div>

    <div v-if="errored" class="text-center">
        <Message severity="error" :closable="false">
            <h4>Ошибка загрузки данных!</h4>
        </Message>
    </div>
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
        card: [],
        cards: [],
        title: null,
        title_list: null,
        board_id: null,
        list_id: null,
        card_id: null,
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
                        this.$toast.add({
                            severity: "success",
                            summary: "Карточка создана",
                            life: 3000,
                        });
                    });
            } else {
                this.$toast.add({
                    severity: "error",
                    summary: "Введите название карточки!",
                    life: 3000,
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

        getCard(id) {
            axios.get(`/api/cards/${id}`).then((response) => {
                this.card = response.data.data;
            });
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

        updateTitleCard(id, title) {
            this.v$.card.title.$touch();
            if (!this.v$.card.title.$error) {
                axios
                    .post(`/api/cards/${id}`, {
                        _method: "PUT",
                        title: title,
                        board_list_id: this.card.board_list_id,
                    })
                    .then((response) => {
                        this.v$.$reset();
                    })
                    .catch((error) => {
                        this.$toast.add({
                            severity: "error",
                            summary: "Введите название карточки!",
                            life: 3000,
                        });
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
        card: {
            title: {
                required,
                // maxLength: maxLength(5),
            },
        },
        cards: {
            required,
            // maxLength: maxLength(5),
        },
    }),
};
</script>

<style scoped>
h2,
h3 {
    cursor: pointer;
}
.card-title {
    cursor: pointer;
}
</style>
