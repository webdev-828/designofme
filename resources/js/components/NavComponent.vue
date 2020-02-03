<template>
    <div class="v_navbar">
        <p class="h1 white-text font-weight-normal text-center mt-2 mb-2">Design of me</p>
        <a href="javscript:void(0);" class="v_navbar_right" v-if="this.$cookies.get('username')" @click="$parent.logout">Logout</a>
    </div>
</template>

<style scoped>
    .v_navbar {
        width: 100%;
        background-color: black;
        padding-top: 10px;
        padding-bottom: 10px;
    }
    .v_navbar_right{
        right:45px;
        top:25px;
        position: absolute;
        font-size: 22px;
        color:#fff;
    }
</style>

<script>
    export default {

    }
</script>
