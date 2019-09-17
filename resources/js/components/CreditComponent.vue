<template>
    <div class='credit-card-inputs' :class='{ complete }'>
        <card-number class='stripe-element card-number'
            ref='cardNumber'
            :stripe='stripe'
            :options='options'
            @change='number = $event.complete'
        />
        <card-expiry class='stripe-element card-expiry'
            ref='cardExpiry'
            :stripe='stripe'
            :options='options'
            @change='expiry = $event.complete'
        />
        <card-cvc class='stripe-element card-cvc'
            ref='cardCvc'
            :stripe='stripe'
            :options='options'
            @change='cvc = $event.complete'
        />
    </div>
</template>

<script>
    import { CardNumber, CardExpiry, CardCvc } from 'vue-stripe-elements-plus'

    export default {
        props: [
            'stripe',
            'options'
        ],
        data () {
            return {
                complete: false,
                number: false,
                expiry: false,
                cvc: false
            }
        },
        components: { CardNumber, CardExpiry, CardCvc },
        methods: {
            update () {
                this.complete = this.number && this.expiry && this.cvc

                // field completed, find field to focus next
                if (this.number) {
                    if (!this.expiry) {
                        this.$refs.cardExpiry.focus()
                    } else if (!this.cvc) {
                        this.$refs.cardCvc.focus()
                    }
                } else if (this.expiry) {
                    if (!this.cvc) {
                        this.$refs.cardCvc.focus()
                    } else if (!this.number) {
                        this.$refs.cardNumber.focus()
                    }
                }
                // no focus magic for the CVC field as it gets complete with three
                // numbers, but can also have four
            }
        },
        watch: {
            number () { this.update() },
            expiry () { this.update() },
            cvc () { this.update() }
        }
    }
</script>

<style scoped>
    .credit-card-inputs.complete {
        border: 2px solid green;
    }
</style>
