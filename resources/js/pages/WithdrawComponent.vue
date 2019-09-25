<template>
    <div>
        <nav-component></nav-component>
        withdraw
    </div>
</template>

<style scoped>

</style>

<script>
    import NavComponent from '../components/NavComponent.vue';
    export default {
        name: 'basic',
        data: function() {
            return {
                username: 'aaa'
            }
        },
        components: {
            'nav-component': NavComponent
        },
        methods: {
            logout(){
                this.$store.commit('setUsername','');
                this.$cookies.remove('username');
                this.$router.push('/');
            }
        }
    }
</script>
