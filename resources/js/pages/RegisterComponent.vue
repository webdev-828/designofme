<template>
    <div>
        <nav-component></nav-component>
        <div class="row v_content-center">
            <div class="col-md-3 v_signup-form">
                <form class="needs-validation" id="needs-validation" novalidate @submit="handleSubmit">
                    <p class="h1 text-center mb-4">Signup</p>
                    <div class="grey-text">
                        <label for="validationCustomName">Name</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrependName">
                                    <i class="fas prefix fa-user"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" id="validationCustomName" aria-describedby="inputGroupPrependName" required v-model="user.name">
                            <div class="invalid-feedback">
                                Please input your first and last name.
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
                        <label for="validationCustomUsername">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrependUsername">
                                    <i class="fas fa-at"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrependUsername" required v-model="user.username">
                            <div class="invalid-feedback">
                                Please input valid username not duplicated.
                            </div>
                        </div>
                        <label for="validationCustomPass">Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrependPass">
                                    <i class="fas prefix fa-lock"></i>
                                </span>
                            </div>
                            <input type="password" class="form-control" id="validationCustomPass" aria-describedby="inputGroupPrependPass" required v-model="user.password">
                            <div class="invalid-feedback">
                                Please input 6 to 20 characters which contain at least one numeric digit, one uppercase and one lowercase letter.
                            </div>
                        </div>
                        <label for="validationCustomConfirm">Confirm Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrependConfirm">
                                    <i class="fas prefix fa-exclamation-triangle"></i>
                                </span>
                            </div>
                            <input type="password" class="form-control" id="validationCustomConfirm" aria-describedby="inputGroupPrependConfirm" required>
                            <div class="invalid-feedback">
                                Please enter a matched password.
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-5">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                            <label class="form-check-label" for="invalidCheck">
                                Agree to terms and conditions
                            </label>
                            <div class="invalid-feedback">
                                You must agree before continuing.
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
                            Sign Up
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
                user: {}
            }
        },
        components: {
            mdbInput,
            mdbBtn,
            'nav-component': NavComponent
        },
        methods: {
            handleSubmit(event) {
                event.preventDefault();
                event.target.classList.add('was-validated');
                var formEl = document.getElementById('needs-validation');
                var emailEl = document.getElementById('validationCustomEmail');
                var usernameEl = document.getElementById('validationCustomUsername');
                var passEl = document.getElementById('validationCustomPass');
                var confEl = document.getElementById('validationCustomConfirm');
                if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.user.email)) {
                    emailEl.value = '';
                };
                let uri = 'api/designofme/checkuser';
                this.axios.get(uri,{
                    params: {
                        email: this.user.email,
                        username: this.user.username
                    }
                })
                .then(response => {
                    if (response.data.useremail > 0) {
                        emailEl.value = '';
                    }
                    if (response.data.username > 0) {
                        usernameEl.value = '';
                    }
                    if (response.data.useremail === 0 && response.data.username === 0) {
                        if (!passEl.value.match(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/)) {
                            passEl.value = '';
                        };
                        if (!(confEl.value === passEl.value)) {
                            confEl.value = '';
                        };
                        var isValid = formEl.checkValidity();
                        if (isValid) {
                            let uri = 'api/designofme/signup';
                            this.axios.post(uri, this.user)
                            .then(response => {
                                if (response.data.status === 'success') {
                                    this.$store.commit('setUsername', response.data.name);
                                    this.$cookies.set('username', response.data.name);
                                    this.$router.push(response.data.name);
                                }
                            })
                            .catch(function(error){
                                console.log(error);
                            });
                        }
                    }
                })
                .catch(function(error){
                    console.log(error);
                });
            }
        }
    }
</script>
