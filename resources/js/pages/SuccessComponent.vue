<template>
    <div>
        <nav-component></nav-component>

        <div class="jumbotron text-center">
        <h1 class="display-3">Thank You!</h1>
        <h2 class="display-3">Your Order Created Successfully</h2>
        <h4 class="display-3">Your OrderId is : {{ order_id }}</h4>
        </div>

        <div class="col-md-6 v_content-center">
            <div class="text-center">
                <mdb-btn
                    style=" width: 500px;
                            heigt: 60px;
                            font-size: 20pt;
                            background-color: black !important;"
                    @click.native="goToHome"
                >
                    Go to home
                </mdb-btn>
            </div>
        </div>
    </div>
</template>

<style scoped>
    .v_content-center {
        display: flex;
        justify-content: center;
    }
    .v_signup-form {
        margin-top: 100px;
    }
    .grey-text>label {
        margin-top: 30px;
    }
    .input-group>input {
        height: 60px;
        font-size: 18px;
        font-weight: lighter;
    }
</style>

<script>
    import { mdbInput, mdbBtn } from 'mdbvue';
    import NavComponent from '../components/NavComponent.vue';

    export default {
        name: 'Basic',
        data: function() {

            return {
                user: {},
                color:"",
                size:"",
                key:"",
                order_id:this.$route.params.id
            }
        },
        components: {
            mdbInput,
            mdbBtn,
            'nav-component': NavComponent
        },
        methods: {
            goToHome() {
                let userName = this.$cookies.get('username');
                this.$router.push("/"+userName);
            }
        }
    }
</script>
