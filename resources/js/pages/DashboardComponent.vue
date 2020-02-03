<template>
    <div>
        <nav-component></nav-component>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <ul class="navbar-nav">
                <li class="nav-item nav-link" v-on:click="sellertab"><a>Sellers</a></li>
                <li class="nav-item nav-link" v-on:click="ordertab"><a>Order Requests</a></li>
                <li class="nav-item nav-link" v-on:click="withdrawtab"><a>Withdraw Requests</a></li>
            </ul>
        </nav>
        <div v-if="tab == 0">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Role</th>
                </tr>
                <tr
                    v-for="user in users"
                    :key="user.id"
                >
                    <td>{{ user.sellername }}</td>
                    <td>{{ user.selleremail }}</td>
                    <td>{{ user.username }}</td>
                    <td v-if="user.role == 0">Seller</td>
                    <td v-if="user.role == 1">Manager</td>
                </tr>
            </table>
        </div>
        <div v-if="tab == 1">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Country</th>
                    <th>City</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Product</th>
                    <th>Color</th>
                    <th>Size</th>
                    <th>Price</th>
                    <th>Seller Name</th>
                    <th>Seller Email</th>
                    <th>Order Status</th>
                    <th>Accept</th>
                    <th>Revoke</th>
                    <th>Identifier</th>
                </tr>
                <tr
                    v-for="order in orders"
                    :key="order.id"
                >
                    <td>{{ order.name }}</td>
                    <td>{{ order.country }}</td>
                    <td>{{ order.city }}</td>
                    <td>{{ order.address }}</td>
                    <td>{{ order.email }}</td>
                    <td>{{ order.phone }}</td>
                    <td>{{ order.image }}</td>
                    <td>{{ order.color }}</td>
                    <td>{{ order.size }}</td>
                    <td>{{ order.prize }}</td>
                    <td>{{ order.sellername }}</td>
                    <td>{{ order.selleremail }}</td>
                    <td v-if="order.status == 0">Failed</td>
                    <td v-if="order.status == 1">Ordered</td>
                    <td v-if="order.status == 2">Delived</td>
                    <td v-if="order.status == 3">Revoked</td>
                    <td class = "v_action">
                        <button
                            class="btn btn-primary"
                            v-on:click="accept"
                            :disabled="order.status !=1"
                        >
                            Accept
                        </button>
                    </td>
                    <td class="v_action">
                        <button
                            class="btn btn-red"
                            v-on:click="revoke"
                            :disabled="order.status !=1"
                        >
                            Revoke
                        </button>
                    </td>
                    <td>{{ order.token }}</td>
                </tr>
            </table>
        </div>
        <div v-if="tab == 2">
            Withdraw
        </div>
    </div>
</template>

<style scoped>
    table {
        font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }
    table td, table th {
        border: 1px solid #dddddd;
        padding: 8px;
    }
    table tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    table tr:hover {
        background-color: #dddddd;
    }
    table th {
        padding-top: 12px;
        padding-bottom: 12px;
        background-color: #4caf50;
        text-align: center;
        color: white;
    }
    table .v_action {
        text-align: center;
    }
</style>

<script>
    import NavComponent from '../components/NavComponent.vue';

    export default {
        name: 'basic',
        data: function() {
            return {
                tab: 0,
                users: Array,
                orders: Array,
                withdraws: Array
            }
        },
        components: {
            'nav-component': NavComponent
        },
        methods: {
            sellertab() {
                this.tab = 0;
                this.getSellers();
            },
            ordertab() {
                this.tab = 1;
                this.getOrders();
            },
            withdrawtab() {
                this.tab = 2;
                this.getWithdraw();
            },
            getSellers() {
                let uri = 'api/designofme/getSellers';
                this.axios.post(uri)
                .then(response => {
                    if (response.data.status === 'failed') {
                        console.log('failed');
                    } else {
                        this.users = response.data;
                    }
                })
                .catch(function(error) {
                    console.log(error);
                })
            },
            getOrders() {
                let uri = 'api/designofme/getOrders';
                this.axios.post(uri)
                .then(response => {
                    if (response.data.status === 'failed') {
                        console.log('failed');
                    } else {
                        this.orders = response.data;
                    }
                })
                .catch(function(error) {
                    console.log(error);
                })
            },
            accept(event) {
                var token = event.target.parentElement.parentElement.children[15].textContent;
                let uri = 'api/designofme/accept?token='+token;
                this.axios.post(uri)
                .then(response => {
                    if (response.data.status === 'failed') {
                        console.log('failed');
                    } else {
                        this.orders = response.data;
                    }
                })
                .catch(function(error) {
                    console.log(error);
                })
            },
            revoke() {
                var token = event.target.parentElement.parentElement.children[15].textContent;
                let uri = 'api/designofme/revoke?token='+token;
                this.axios.post(uri)
                .then(response => {
                    if (response.data.status === 'failed') {
                        console.log('failed');
                    } else {
                        this.orders = response.data;
                    }
                })
                .catch(function(error) {
                    console.log(error);
                })
            },
            getWithdraw() {
                let uri = 'api/designofme/getWithdraws';
                this.axios.post(uri)
                .then(response => {
                        console.log(response.data)
                })
                .catch(function(error) {
                    console.log(error);
                })
            },
            logout(){
                this.$store.commit('setUsername','');
                this.$cookies.remove('username');
                this.$cookies.remove('token');
                this.$router.push('/');
            }
        },
        mounted: function() {
            this.getSellers();
        }
    }
</script>
