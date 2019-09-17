<template>
    <div class="row v_content-center">
        <div class="v_shape">
            <img v-bind:src="my_shape">
        </div>
        <div class="v_rectangle"></div>
        <div class="v_circle"></div>
    </div>
</template>

<style scoped>
    .v_rectangle {
        width: 100%;
        height: 5px;
        background-color: black;
    }
    .v_circle {
        position: relative;
        width: 28px;
        height: 28px;
        top: -5%;
        background-color: black;
        border-color: black;
        border-radius: 50%;
    }
</style>

<script>
    export default {
        props: [
            'my_shape',
            'circle'
        ]
    }
</script>
