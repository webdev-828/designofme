<template>
    <div>
        <nav-component></nav-component>
        <div class="row v_content-center">
            <div class="col-md-3 v_signup-form">
                <form class="needs-validation" id="needs-validation" novalidate @submit="handleSubmit">
                    <p class="h1 text-center mb-4">Checkout</p>
                    <div class="grey-text">
                        <label for="validationCustomFirstName">First Name</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrependName">
                                    <i class="fas prefix fa-user"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" id="validationCustomFirstName" aria-describedby="inputGroupPrependName" required v-model="user.firstname">
                            <div class="invalid-feedback">
                                Please input your first name.
                            </div>
                        </div>

                        <label for="validationCustomLastName">Last Name</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrependName">
                                    <i class="fas prefix fa-user"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" id="validationCustomLastName" aria-describedby="inputGroupPrependName" required v-model="user.lastname">
                            <div class="invalid-feedback">
                                Please input your last name.
                            </div>
                        </div>

                        <label for="validationCustomCity">City</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrependCity">
                                    <i class="fas prefix fa-user"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" id="validationCustomCity" aria-describedby="inputGroupPrependCity" required v-model="user.city">
                            <div class="invalid-feedback">
                                Please input your city name.
                            </div>
                        </div>

                        <label for="validationCustomCountry">Country</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrependCountry">
                                    <i class="fas prefix fa-user"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" id="validationCustomCountry" aria-describedby="inputGroupPrependCountry" required v-model="user.country">
                            <div class="invalid-feedback">
                                Please input your country name.
                            </div>
                        </div>

                        <label for="validationCustomAddress">Address</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrependAddress">
                                    <i class="fas prefix fa-user"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" id="validationCustomAddress" aria-describedby="inputGroupPrependAddress" required v-model="user.address">
                            <div class="invalid-feedback">
                                Please input your address.
                            </div>
                        </div>

                        <label for="validationCustomZipcode">Zipcode</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrependZipcode">
                                    <i class="fas prefix fa-user"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" id="validationCustomZipcode" aria-describedby="inputGroupPrependZipcode" required v-model="user.zipcode">
                            <div class="invalid-feedback">
                                Please input zipcode.
                            </div>
                        </div>


                        <label for="validationCustomEmail">Email</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrependEmail">
                                    <i class="fas prefix fa-envelope"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" id="validationCustomEmail" aria-describedby="inputGroupPrependEmail" required v-model="user.email">
                            <div class="invalid-feedback">
                                Please input valid email not duplicated.
                            </div>
                        </div>

                        <label for="validationCustomPhone">Phone Number</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrependPhone">
                                    <i class="fas prefix fa-user"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" id="validationCustomPhone" aria-describedby="inputGroupPrependPhone" required v-model="user.phone">
                            <div class="invalid-feedback">
                                Please enter phone number.
                            </div>
                        </div>
                    </div>

                    <div class="v_content-center">
                        <mdb-btn
                            type = "submit"
                            style=" width: 500px;
                                    heigt: 60px;
                                    margin: 30px 0px 0px 0px;
                                    font-size: 20pt;
                                    background-color: black !important;"
                        >
                            Checkout
                        </mdb-btn>
                    </div>
                </form>
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
            }
        },
        components: {
            mdbInput,
            mdbBtn,
            'nav-component': NavComponent
        },
        methods: {
            handleSubmit(event) {
                this.key = this.$route.params.id;
                this.color = this.$route.params.color;
                this.size = this.$route.params.size;

                this.user.product_key = this.key;
                this.user.color = this.color;
                this.user.size = this.size;

                event.preventDefault();
                event.target.classList.add('was-validated');
                var formEl = document.getElementById('needs-validation');
                var emailEl = document.getElementById('validationCustomEmail');
                var firstEl = document.getElementById('validationCustomFirstName');
                var lastEl = document.getElementById('validationCustomLastName');
                var phoneEl = document.getElementById('validationCustomPhone');
                var countryEl = document.getElementById('validationCustomCountry');
                var addresEl = document.getElementById('validationCustomAddress');
                var cityEl = document.getElementById('validationCustomCity');
                var zipcodeEl = document.getElementById('validationCustomZipcode');

                if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.user.email)) {
                    emailEl.value = '';
                    return false;
                };

                console.log("USER DETAILS");
                console.log(this.user);

                let uri = '../../../../api/designofme/checkout';
                this.axios.post(uri, this.user)
                .then(response => {
                    if (response.data.status === 'success') {
                        window.location.href = "https://sandbox-cpp.iyzipay.com/?token="+response.data.token
                    } else {
                        console.log("Failed");
                    }
                })
                .catch(function(error){
                    console.log(error);
                });
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
