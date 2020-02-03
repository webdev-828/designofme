<template>
    <div>
        <nav-component></nav-component>
        <div class="container">
            <div class="row v_content-center">
                <div class="col-md-12 v_content-center">
                    <p class="v_username mt-5">{{ username }}</p>
                </div>
                <div
                    v-for="info in infos"
                    :key="info.id"
                    class="col-md-4 mb-5"
                >
                    <info-component :amount="info.amount" :text="info.text"></info-component>
                </div>
                <div class="col-md-6 v_content-center">
                    <div class="text-center mt-5">
                        <mdb-btn
                            style=" width: 500px;
                                    heigt: 70px;
                                    font-size: 18pt;
                                    background-color: black !important;"
                            @click.native="withdraw"
                        >
                            Withdraw Money
                        </mdb-btn>
                    </div>
                </div>
                <div class="col-md-6 v_content-center">
                    <div class="text-center mt-5">
                        <mdb-btn
                            style=" width: 500px;
                                    heigt: 70px;
                                    font-size: 18pt;
                                    background-color: black !important;"
                            @click.native="create"
                        >
                            Add an Apparel
                        </mdb-btn>
                    </div>
                </div>
                <div class="col-md-12">
                    <p class="v_activelink mt-5">Active Links</p>
                    <p
                        class="v_link mt-1"
                        v-for="link in links"
                        :key="link.id"
                    >
                        {{ host +'/' + username + '/' + link }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
    .v_content-center {
        display: flex;
        justify-content: center;
    }
    .v_username {
        color: grey;
        font-weight: normal;
        font-size: 40px;
    }
    .v_activelink {
        font-weight: bold;
        font-size: 30px;
        color: grey;
    }
    .v_link {
        font-weight: normal;
        font-size: 30px;
        color: grey;
    }
</style>

<script>
    import { mdbInput, mdbBtn } from 'mdbvue';
    import NavComponent from '../components/NavComponent.vue';
    import InfoComponent from '../components/InfoComponent.vue';

    export default {
        name: 'Basic',
        components: {
            mdbInput,
            mdbBtn,
            'nav-component': NavComponent,
            'info-component': InfoComponent
        },
        data: function() {
            let uri = 'api/designofme/fetchuser?username=' + this.$cookies.get('username');
            console.log(this.$cookies.get('laravel_session'));
            console.log('reached out here');
            this.axios.post(uri)
            .then(response => {
                this.host = response.data.host;
                this.infos[0].amount = response.data.sales;
                this.infos[1].amount = response.data.earning + ' $';
                this.infos[2].amount = response.data.view;
                this.links = response.data.products;
            })
            .catch(function(error) {
                console.log(error);
            })
            return {
                host: String,
                username: this.$cookies.get('username'),
                infos: [
                    {
                        id: 0,
                        amount: String,
                        text: 'Sales'
                    },
                    {
                        id: 1,
                        amount: String,
                        text: 'Earning'
                    },
                    {
                        id: 2,
                        amount: String,
                        text: 'View'
                    }
                ],
                links: Array
            }
        },
        methods: {
            withdraw() {
                console.log('reached out here');
                this.$router.push('withdraw')
            },
            create() {
                this.$router.push(this.$store.getters.username + '/createapparel');
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
