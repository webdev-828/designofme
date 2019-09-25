<template>
    <div>
        <nav-component></nav-component>
        <div class="container">
            <form class="needs-validation" id="needs-validation" novalidate @submit="handleSubmit">
                <div class="row v_content-center">
                    <div class="col-md-12 v_content-center">
                        <p class="v_user mt-5">Made by {{ username }}</p>
                    </div>
                    <div class="container-fluid">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <img :src="tshirt" width="600" height="700" style="margin-left:240px;">
                        </div>
                        <div class="col-md-4"></div>
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <h3 style="text-align:center;">
                                    {{price}}
                                </h3>
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <h3 style="text-align:center;">100% Cotton Eco-friendly Handmade
                                    with an eye for design
                                </h3>
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3">
                                <select name="texttype"  class="font-control v_select_type text-center" @change="onChangeSize($event)" >
                                    <option value="">Select Size</option>
                                    <option value="m">M</option>
                                    <option value="l">L</option>
                                    <option value="xl">XL</option>
                                </select>
                                <p v-if="ifEmptySize" class="invalid-feedback1">Please select size</p>
                            </div>
                            <div class="col-md-3">
                                <select name="texttype"  class="font-control v_select_type text-center" @change="onChangeColor($event)">
                                    <option value="">Select Color</option>
                                    <option value="blue">Blue</option>
                                    <option value="green">Green</option>
                                    <option value="red">Red</option>
                                </select>
                                <p v-if="ifEmptyColor" class="invalid-feedback1">Please select color</p>
                            </div>
                            <div class="col-md-3"></div>

                            <div class="col-md-4"></div>
                            <div class="col-md-4" style="margin-bottom:100px;">
                                <div class="v_outer">
                                    <div class="text-center v_left">
                                        <mdb-btn
                                            style="margin-left:-42px"
                                            class="v_active"
                                            id="logoBtn"
                                            v-on:click="clickBuy" >
                                            Buy
                                        </mdb-btn>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<style scoped>
    .v_user {
        color: grey;
        font-weight: normal;
        font-size: 40px;
    }
    .v_content-center {
        display: flex;
        justify-content: center;
    }
    .v_outer {
        position: relative;
    }
    .v_left {
        position: absolute;
        left: 0px;
    }
    .v_right {
        position: absolute;
        right: 0px;
    }
    .v_active {
        width: 450px;
        height: 60px;
        font-size: 20pt;
        margin-right: 0px;
        margin-left: 0px;
        background-color: black !important;
    }
    .v_nonactive {
        width: 450px;
        height: 60px;
        font-size: 20pt;
        margin-right: 0px;
        margin-left: 0px;
        background-color: grey !important;
    }
    .v_time-prize {
        margin: 100px 0px 0px 0px;
    }
    .v_prize {
        height: 48px;
        font-size: 20px;
        color: black;
        text-align: right;
    }
    .v_pend {
        background-color: white;
        border: none;
    }
    .v_tshirt-view {
        padding: 0px;
        margin-top: 32px;
    }
    .v_select_type{
        width: 220px;
        height: 40px;
        border: 1px solid #ddd;
        padding: 0px 10px;
        font-size: 22px;
        -webkit-appearance :menulist;
    }
    .invalid-feedback1{
        color:#dc3545;
        width: 100%;
        margin-top: .25rem;
        font-size: 80%;
        color: #DB3545;
    }
</style>

<script>
    import { mdbInput, mdbBtn } from 'mdbvue';
    import {Money} from 'v-money';
    import NavComponent from '../components/NavComponent.vue';
    import LogoComponent from '../components/LogoComponent.vue';
    import TextComponent from '../components/TextComponent.vue';
    import mark from '../../assets/images/mark.png';

    export default {
        name: 'Basic',
        components: {
            mdbInput,
            mdbBtn,
            Money,
            'nav-component': NavComponent,
            'logo-component': LogoComponent,
            'text-component': TextComponent
        },

        data: function() {
            let product_key = this.$route.params.id;

            let uri = '../api/designofme/getproduct?id='+product_key;
            this.axios.get(uri)
            .then(response=> {
                if (response.data === 'failed') {
                    console.log("failed");
                    window.location.href ="/404";
                }
                else {
                    this.price=response.data.data.price;
                    this.username=response.data.data.username;
                    this.tshirt="../images/designs/"+response.data.data.image;
                }
            })
            .catch(function(error){
                console.log(error);
            });

            return {
                username: '',
                tshirt:'../../assets/images/tshirt.png',
                mark: mark,
                price: "",
                color:"",
                size:"",
                time : '',
                ifEmptySize : false,
                ifEmptyColor : false
            }
        },
        methods: {
            onChangeColor(event) {
                this.color = event.target.value;
            },
            onChangeSize(event) {
                this.size = event.target.value;
            },
            clickBuy(){
                this.ifEmptySize = false;
                this.ifEmptyColor = false;

                let product_key = this.$route.params.id;
                let username_k = this.$route.params.username;
                if(this.size =="" || this.size == null){

                    this.ifEmptySize = true;
                    return false;
                }
                if(this.color =="" || this.color ==null){
                    this.ifEmptyColor = true;
                    return false;
                }
                this.$router.push({path: '/checkout/'+username_k+'/'+product_key+'/'+this.color+'/'+this.size});
            },
            handleSubmit(event) {
                event.preventDefault();
                event.target.classList.add('was-validated');
                var formEl = document.getElementById('needs-validation');
            }
        }
    }
</script>
