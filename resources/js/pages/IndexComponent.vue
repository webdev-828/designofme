<template>
    <div class="container">
        <div class="row v_content-center">
            <div class="col-md-11 v_content-center">
                <p class="h1 font-weight-lighter text-center mt-5 mb-5 v_logo-text">designof.me</p>
            </div>
            <div class="col-md-6 v_content-center">
                <div class="text-center">
                    <mdb-btn
                        style=" width: 500px;
                                heigt: 60px;
                                font-size: 20pt;
                                background-color: black !important;"
                        @click.native="signup"
                    >
                        Register
                    </mdb-btn>
                </div>
            </div>
            <div class="col-md-6 v_content-center">
                <div class="text-center">
                    <mdb-btn
                        style=" width: 500px;
                                heigt: 60px;
                                font-size: 20pt;
                                background-color: black !important;"
                        @click.native="login"
                    >
                        Login
                    </mdb-btn>
                </div>
            </div>
            <div class="col-md-12 v_content-center">
                <p class="v_app-text">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam in ultrices libero. Aenean imperdiet nec quam ac ultricies. Phasellus sed aliquam lectus, non ultrices tellus. Sed imperdiet nec neque sit amet imperdiet. Nullam vel laoreet sapien, eget lacinia quam. Donec eleifend aliquet tellus vel facilisis. Duis eros sapien, iaculis aliquet sodales ut, tempor sit amet magna. Vestibulum finibus a odio sed condimentum. Suspendisse et laoreet lacus. Curabitur id quam tristique, pellentesque felis ac, cursus justo. In hac habitasse platea dictumst. In hendrerit mi ac ultricies dapibus. In hac habitasse platea dictumst. Phasellus placerat iaculis nisi id euismod. Ut maximus fringilla lacinia.
                </p>
            </div>
            <div
                v-for="shape in shapes"
                :key="shape.id"
                class="col-md-4 v_content-center"
            >
                <shape-component :my_shape="shape.name" :circle="circle"></shape-component>
            </div>
        </div>
    </div>
</template>

<style scoped>
    .v_logo-text {
        font-size: 70pt;
        font-weight: lighter;
    }
    .v_app-text {
        font-size: 18pt;
        margin-top: 60px;
        color: grey;
        text-align: center;
    }
    .v_content-center {
        display: flex;
        justify-content: center;
    }
</style>

<script>
    import { mdbInput, mdbBtn } from 'mdbvue';
    import ShapeComponent from '../components/ShapeComponent.vue';
    import shape1 from '../../assets/images/shape1.png';
    import shape2 from '../../assets/images/shape2.png';
    import shape3 from '../../assets/images/shape3.png';
    import circle from '../../assets/images/circle.png';
    export default {
        name: 'Basic',
        components: {
            mdbInput,
            mdbBtn,
            'shape-component': ShapeComponent
        },
        data: function() {
            return {
                shapes: [
                    {
                        id:0,
                        name:shape1
                    },
                    {
                        id:1,
                        name:shape2
                    },
                    {
                        id:2,
                        name:shape3
                    }
                ],
                circle: circle
            }
        },
        methods: {
            signup() {
                this.$router.push('register');
            },
            login() {
                this.$router.push('login');
            },
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
