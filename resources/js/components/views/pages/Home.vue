<template>
    <div class="row justify-content-center">
        <div class="col col-md-2 w-50 my-4">
            <form @submit.prevent="addNewBoard">
                <span class="p-float-label">
                    <InputText
                        :class="{ 'p-invalid': v$.title.$error }"
                        id="title"
                        type="text"
                        v-model="title"
                        class="w-100"
                    />
                    <label for="title">Создать доску</label>
                </span>

                <div
                    class="text-center"
                    v-for="error of v$.title.$errors"
                    :key="error.$uid"
                >
                    <span v-if="error.$validator == 'required'">
                        <small class="p-error">Введите название доски!</small>
                    </span>

                    <span v-if="error.$validator == 'maxLength'">
                        <small class="p-error">
                            Максимальное количество символов:
                            {{ error.$params.max }}
                        </small>
                    </span>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div
            class="col-md-6 col-lg-4 col-xl-3 my-3"
            v-for="board in boards"
            :key="board.id"
        >
            <Card>
                <template #header>
                    <div class="d-flex justify-content-end">
                        <Button
                            class="p-button p-component p-button-icon-only p-button-rounded p-button-danger p-button-text"
                            @click="deleteBoard(board.id)"
                        >
                            <span class="pi pi-trash p-button-icon"></span>
                        </Button>
                    </div>
                </template>
                <template #content>
                    <router-link
                        :to="{ name: 'board', params: { id: board.id } }"
                    >
                        {{ board.title }}
                    </router-link>
                </template>
            </Card>
        </div>
    </div>

    <div v-if="loader" class="text-center"><h4>загрузка...</h4></div>
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
    name: "Home",
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
                        this.v$.$reset();
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
