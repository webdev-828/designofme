<template>
    <div class="v_content-center">
        <div class="rounded-circle v_card mt-4" data-holder-rendered="true">
            <p class="h2 font-weight-bold">{{ amount }}</p>
            <p class="h3 grey-text font-weight-normal">{{ text }}</p>
        </div>
    </div>
</template>

<style scoped>
    .v_card {
        width: 200px;
        height: 200px;
        border-color: grey;
        border-style: solid;
        border-width: 1px;
        text-align: center;
        padding-top: 70px;
    }
</style>

<script>
    import { mdbInput, mdbBtn } from 'mdbvue';

    export default {
        name: 'Basic',
        components: {
            mdbInput,
            mdbBtn
        },
        props: [
            'amount',
            'text'
        ]
    }
</script>
