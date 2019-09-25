<template>
    <div>
        <div class="container v_text-set">
            <div class="row">
                <div class="col-md-6 ">
                    <textarea class="v_text-content form-control" name="" id="" v-on:keyup="handleClick" cols="40" rows="10" v-model="text"></textarea>
                </div>
                <div class="col-md-6">
                    <span class="input-group-text black-text font-weight-bold v_text-type">Choose Text Type</span>
                    <div>
                        <select name="texttype"  v-model="texttype" v-on:change="handleClick"  class="font-control v_select_type" v-bind:required="true">
                            <option value="font-normal">Text Type 01</option>
                            <option value="font-italic">Text Type 02</option>
                            <option value="font-bold">Text Type 03</option>
                            <option value="font-b_italic">Text Type 04</option>
                        </select>
                    </div>
                    <div>
                        <span class="input-group-text black-text font-weight-bold v_text-type">Text Size</span>
                        <div>
                            <span class="v_rangbox">{{textsize}}</span>
                            <input type="range" min="10" max="50" step="1" v-model="textsize"  v-on:change="handleClick">
                        </div>
                    </div>
                    <div>
                        <span class="input-group-text black-text font-weight-bold v_text-type">Choose Color</span>
                        <div>
                            <input type="radio" name="textcolor" class="custom-radio"  v-model="textcolor" value="#ef3131" label="Red" v-bind:inverted="true" v-bind:checked="true" v-bind:required="true" v-on:change="handleClick"><span class="redbox radio_color_box"></span>
                            <input type="radio" name="textcolor" class="custom-radio" v-model="textcolor" value="#316cee" label="Blue" v-bind:inverted="true" v-bind:checked="false" v-bind:required="true" v-on:change="handleClick"><span class="bluebox radio_color_box"></span>
                            <input type="radio" name="textcolor" class="custom-radio" v-model="textcolor" value="#000000" label="Black" v-bind:inverted="true" v-bind:checked="false" v-bind:required="true" v-on:change="handleClick"><span class="blackbox radio_color_box"></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 v_product" id="preview_tshirt" ref="printMe">
                    <div class="v_content-center v_tshirt">
                        <img :src="tshirt">
                    </div>
                    <div>
                        <label id="shirt-text" class="v_text-normal"><pre>{{ text }}</pre></label>
                    </div>
                </div>
                <div class="col-md-12 v_content-center">
                    <p v-if="isLoading">Uploading</p>
                    <p class="v_user mt-1" v-if="isUploaded">Your design ready to share</p>
                </div>
                <div class="col-md-12 v_content-center v_link">
                    <h4 v-if="isUploaded"><a v-bind:href="productUrl" v-html="productUrl"></a></h4>
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
    </div>
</template>

<style scoped>
    #shirt-text pre{
        font-size: inherit;
        color: inherit;
    }
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
        margin-top: 40px;
        background-color: #a3bbca;
        width: 100%;
        height: 100%;
    }
    .v_tshirt {
        padding: 120px 0px 120px 0px;
    }
    .v_text-content {
        width: 80%;
        border-color: black;
        border-width: 1px;
        border-style: solid;

    }
    .v_text-type {
        background-color: white;
        border: none;
        font-size: 24px;
    }
    .v_text-normal {
        position: absolute;
        top: 42%;
        right: 36%;
        font-weight: normal;
        font-size: 30px;
        letter-spacing: 2px;
    }
    .v_text-italic {
        position: absolute;
        top: 42%;
        right: 36%;
        font-weight: normal;
        font-style: italic;
        font-size: 30px;
        letter-spacing: 2px;
    }
    .v_text-bold {
        position: absolute;
        top: 42%;
        right: 36%;
        font-weight: bold;
        font-size: 30px;
        letter-spacing: 2px;
    }
    .v_text-bold-italic {
        position: absolute;
        top: 42%;
        right: 36%;
        font-weight: bold;
        font-style: italic;
        font-size: 30px;
        letter-spacing: 2px;
    }
    .v_action {
        color: black;
        font-size: 20px;
        margin-top: -30px;
         font-weight: bold;
    }
    .v_select_type {
        width: 220px;
        height: 40px;
        border: 1px solid #ddd;
        padding: 0px 10px;
        font-size: 22px;
        -webkit-appearance :menulist;
    }
    .v_rangbox {
        height: 40px;
        width: 40px;
        border: 1px solid #ddd;
        font-size: 17px;
        float: left;
        margin: -7px 8px 0px;
        text-align: center;
        vertical-align: middle;
        line-height: 37px;
    }
    .v_link {
        margin-top: -40px;
    }
    .custom-radio {
        margin: 0px 10px;
        font-size: 24px;
        width: 25px;
        height: 25px;
        float:left;
    }
    .radio_color_box {
        float: left;
        border:1px solid #ddd;
        height: 25px;
        width: 25px;
    }
    .radio_color_box.redbox {
        background-color: #ef3131;
    }
    .radio_color_box.bluebox {
        background-color: #316cee;
    }
    .radio_color_box.blackbox {
        background-color: #000000;
    }
    .atag a{
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
    import { mdbInput, mdbBtn } from 'mdbvue';
    import Vue from 'vue';
    import VueHtml2Canvas from 'vue-html2canvas';
    import RadioComponent from '../components/RadioComponent.vue';
    import tshirt from '../../assets/images/tshirt.png';
    Vue.use(VueHtml2Canvas);
    var fileLogo = false,file_path ="";
    export default {
        name: 'InputsProPage',
        components: {
            mdbInput,
            mdbBtn,
            radio: RadioComponent
        },
        data: function() {
            return {
                tshirt: tshirt,
                text: '',
                texttype: 'font-normal',
                textsize: 26,
                textcolor: "#ef3131",
                image: new Image(),
                output: null,
                isUploaded: false,
                isLoading: false,
                productUrl : '',
            }
        },
        methods: {
            async share() {
                const el = this.$refs.printMe;
                const options = { type: 'dataURL' }
                if(this.text == '' && this.text ==null){
                    alert('Please enter text');
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
                product.type = 'text';

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
                            this.text = '';
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
                if(file_path !=""){
                    var a = document.createElement('A');
                    a.href = file_path;
                    a.download = file_path.substr(file_path.lastIndexOf('/') + 1);
                    document.body.appendChild(a);
                    a.click();
                    document.body.removeChild(a);
                }
                console.log("download");
            },
            make() {
                console.log("make");
                this.text = '';
                this.isUploaded = false;
                this.productUrl = '';
                file_path = '';
                this.isLoading = false;
                console.log("make");
            },
            handleClick: function(val) {
                var el = document.getElementById('shirt-text');
                el.removeAttribute("style");
                if (this.texttype === 'font-normal') {
                    el.classList.replace(el.className, 'v_text-normal');
                }
                if (this.texttype === 'font-italic') {
                    el.classList.replace(el.className, 'v_text-italic');
                }
                if (this.texttype == 'font-bold') {
                    el.classList.replace(el.className, 'v_text-bold');
                }
                if (this.texttype == 'font-b_italic') {
                    el.classList.replace(el.className, 'v_text-bold-italic');
                }
                el.style.fontSize = this.textsize+'px';
                el.style.color = this.textcolor;
            }
        }
    }
</script>
