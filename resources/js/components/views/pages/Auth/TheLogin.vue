<template>
    <div class="uk-flex uk-height-large">
        <div class="uk-margin-auto uk-margin-auto-vertical uk-width-1-3">
            <app-form-login></app-form-login>
            <div class="uk-padding uk-padding-remove-right uk-text-right">
                <app-button-link-default :to="{ name: 'register' }"
                    >Регистрация</app-button-link-default
                >
                <app-button-secondary :class="'uk-margin-left'">
                    Войти
                </app-button-secondary>
            </div>
        </div>
    </div>
</template>

<script>
import AppFormLogin from "../../../components/forms/app-form-login.vue";
import AppButtonSecondary from "../../../components/buttons/app-button-secondary.vue";
import AppButtonLinkDefault from "../../../components/buttons-link/app-button-link-default.vue";

export default {
    name: "TheLogin",
    components: {
        AppFormLogin,
        AppButtonSecondary,
        AppButtonLinkDefault,
    },
};
</script>
