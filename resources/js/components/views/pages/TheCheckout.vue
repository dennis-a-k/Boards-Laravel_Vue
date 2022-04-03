<template>
    <div
        class="uk-grid-medium uk-child-width-1-1 uk-grid uk-grid-stack"
        uk-grid
    >
        <div class="uk-text-center uk-text-large uk-first-column">
            <router-link
                class="uk-link-muted uk-text-small uk-link-heading"
                :to="{ name: 'cart' }"
            >
                <span
                    class="uk-margin-xsmall-right uk-icon uk-text-middle"
                    uk-icon="icon: arrow-left; ratio: .75;"
                ></span>
                Вернуться в корзину
            </router-link>
            <h1 class="uk-margin-small-top uk-margin-remove-bottom">
                Оформление заказа
            </h1>
        </div>
        <div class="uk-grid-margin uk-first-column">
            <div class="uk-grid-medium uk-grid" uk-grid>
                <!-- Форма для оформления корзины -->
                <app-form-checkout></app-form-checkout>

                <!-- Блок для оформления корзины -->
                <app-block-cart-checkout></app-block-cart-checkout>
            </div>
        </div>
    </div>
</template>

<script>
import AppFormCheckout from "../../components/forms/app-form-checkout.vue";
import AppBlockCartCheckout from "../../components/cards/blocks/app-block-cart-checkout.vue";

export default {
    name: "TheCheckout",
    components: {
        AppFormCheckout,
        AppBlockCartCheckout,
    },
};
</script>
