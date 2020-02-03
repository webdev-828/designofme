<template>
    <div>
        <nav-component></nav-component>
        <card-component @input="onclick" :buttonName="'continue'"></card-component>
    </div>
</template>

<style scoped>

</style>

<script>
    import NavComponent from '../components/NavComponent.vue';
    import CreditCardComponent from '../components/CreditCardComponent.vue';
    export default {
        data: function() {

            return {
                isInput: 0
            }
        },
        components: {
            'nav-component': NavComponent,
            'card-component': CreditCardComponent
        },
        methods: {
            onclick(cardNum, cardOwner, cardMonth, cardYear, cardCvc) {
            },
            logout(){
                this.$store.commit('setUsername','');
                this.$cookies.remove('username');
                this.$cookies.remove('token');
                this.$router.push('/');
            }
        }
    }
</script>
