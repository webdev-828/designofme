<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6 ">
                <input type="file"  class="form-control" v-on:change="onImageChange" ref="fileInput">
            </div>
            <div class="col-md-6">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 v_product" id="preview_tshirt" ref="printMe">
                <span>
                    <div class="v_content-center v_tshirt">
                        <img :src="tshirt">
                    </div>
                    <div class="v_logo">
                        <img :src="logo" width="60px">
                    </div>
                </span>
            </div>
            <div class="col-md-12 v_content-center">
                <p v-if="isLoading">Uploading</p>
                <p class="v_user mt-1" v-if="isUploaded">Your design ready to share  s</p>
            </div>
            <div class="col-md-12 v_content-center v_link">
                <h4 v-if="isUploaded"><a v-bind:href="productUrl" v-html="productUrl"></a></h4>
                <br/>
            </div>

            <div class="col-md-12 v_action v_share v_content-center">
                <div class="atag">
                    <a @click.prevent="share">Share Link</a> <span class="atag_slash">/</span>
                </div>
                <div class="atag">
                  <a @click.prevent="download">Download Picture</a> <span class="atag_slash">/</span>
                </div>
                <div class="atag">
                    <a @click.prevent="make">Make Another</a>
                </div>
            </div>
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
    .v_product {
        position: relative;
        background-color: #a3bbca;
        width: 100%;
        height: 100%;
    }
    .v_tshirt {
        padding: 120px 0px 120px 0px;
    }
    .v_logo {
        position: absolute;
        top: 40%;
        right: 40%;
    }
    .v_action {
        color: black;
        font-size: 20px;
        margin-top: -30px;
        font-weight: bold;
    }
    .v_link {
        margin-top: -40px;
    }
    .atag a {
        margin: 0px 10px;
    }
    @media only screen and (max-width:767px){
        .atag {
            width: 100%;
            text-align: center;
        }
        .atag .atag_slash{
            display: none;
        }
        .v_content-center {
            display: block;
        }
        .v_tshirt img{
            width: 100%;
        }
        .v_logo{
            right:30%;
        }
    }
</style>

<script>
    import Vue from 'vue';
    import tshirt from '../../assets/images/tshirt.png';
    import logo from '../../assets/images/logo.png';
    import VueHtml2Canvas from 'vue-html2canvas';
    Vue.use(VueHtml2Canvas);

    var fileLogo = false,file_path ="";
    export default {
        data: function() {
            return {
                tshirt: tshirt,
                logo: logo,
                output: null,
                isUploaded: false,
                isLoading: false,
                filelogo : '',
                productUrl : '',

            }
        },
        methods: {
            onImageChange(e) {
                const file = e.target.files[0];
                this.logo = URL.createObjectURL(file);
                fileLogo = true;
            },
            async share() {
                this.isUploaded = false;
                const el = this.$refs.printMe;
                const options = { type: 'dataURL' }
                if(fileLogo == false){
                    alert('Please select logo');
                    return false;
                }
                this.isLoading = true;
                this.output = await this.$html2canvas(el, options);

                let uri = '/api/designofme/addproduct/';
                let product = {};
                product.price = this.$parent.price;
                product.time = this.$parent.time;
                product.logo = this.output;
                product.username= this.$cookies.get('username');
                product.type = 'logo';

                this.axios.defaults.headers.common['X-CSRF-TOKEN'] = window.csrf_token;
                this.axios.post(uri, product)
                    .then(response=> {
                        console.log(response);
                        if (response.data.status === 'failed') {
                            this.isUploaded = false;
                            alert(response.data.message);
                        }
                        else {
                            this.isUploaded = true;
                            this.productUrl =response.data.product_id;
                            this.$refs.fileInput.value = null;
                            file_path = response.data.product_image;
                            alert(response.data.message)
                        }
                        this.isLoading = false;
                    })
                    .catch(function(error){
                        alert('error'+response.data.message)
                    });
                console.log("share");
            },
            download() {
                console.log("download");
                if(file_path !=""){
                    var a = document.createElement('A');
                    a.href = file_path;
                    a.download = file_path.substr(file_path.lastIndexOf('/') + 1);
                    document.body.appendChild(a);
                    a.click();
                    document.body.removeChild(a);
                }
            },
            make() {
                console.log("make");
                this.$refs.fileInput.value = null;
                this.logo = logo;
                this.isUploaded = false;
                this.productUrl = '';
                file_path = '';
                this.isLoading = false;
            },
            mounted() {
                this.share()
          }
        }
    }
</script>
