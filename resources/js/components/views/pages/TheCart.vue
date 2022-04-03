<template>
    <div
        class="uk-grid-medium uk-child-width-1-1 uk-grid uk-grid-stack"
        uk-grid
    >
        <div class="uk-text-center uk-text-large uk-first-column">
            <h1 class="uk-margin-small-top uk-margin-remove-bottom">Корзина</h1>
        </div>
        <div class="uk-grid-margin uk-first-column">
            <div class="uk-grid-medium uk-grid" uk-grid>
                <div class="uk-width-1-1 uk-width-expand@m uk-first-column">
                    <div class="uk-card uk-card-default uk-card-small">
                        <header
                            class="uk-card-header uk-text-uppercase uk-text-muted uk-text-center uk-text-small uk-visible@m"
                        >
                            <div
                                class="uk-grid-small uk-child-width-1-2 uk-grid"
                                uk-grid
                            >
                                <div class="uk-first-column">Товар</div>
                                <div>
                                    <div
                                        class="uk-grid-small uk-child-width-expand uk-grid"
                                        uk-grid
                                    >
                                        <div class="uk-first-column">Цена</div>
                                        <div class="tm-quantity-column">
                                            Количество
                                        </div>
                                        <div>Сумма</div>
                                        <div class="uk-width-auto">
                                            <div style="width: 20px"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </header>

                        <!-- Карточка товаров -->
                        <app-card-cart-product></app-card-cart-product>
                        <app-card-cart-product></app-card-cart-product>
                        <app-card-cart-product></app-card-cart-product>
                        <app-card-cart-product></app-card-cart-product>
                        <app-card-cart-product></app-card-cart-product>
                    </div>
                </div>

                <!-- Блок для оформления корзины -->
                <app-block-cart-checkout></app-block-cart-checkout>
            </div>
        </div>
    </div>
</template>

<script>
import AppCardCartProduct from "../../components/cards/app-card-cart-product.vue";
import AppBlockCartCheckout from "../../components/cards/blocks/app-block-cart-checkout.vue";

export default {
    name: "TheCart",
    components: {
        AppCardCartProduct,
        AppBlockCartCheckout,
    },
};
</script>
