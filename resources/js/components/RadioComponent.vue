<template>
    <div class="custom-radio" v-bind:class="{ inverted: inverted }">
        <input type="radio" v-bind:name="name" v-bind:class="className" v-bind:id="id" v-bind:checked="checked" v-bind:value="value" v-bind:required="required" v-on:change="updateInput" />
        <label v-bind:id="id" v-bind:for="id">{{ label }}</label>
    </div>
</template>

<style lang="scss" scoped>
    .custom-radio {
        padding: 5px;
        margin: 5px auto;
        input[type=radio],
        label {
            user-select: none;
            vertical-align: middle;
        }
        input{
            display: none;
        }
        input[type=checkbox],
        input[type=radio] {
            -webkit-appearance: none;
            -webkit-border-radius: 0;
            transition: all 0.2s ease;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;

            &:focus {
                outline: 0;
            }
            &:active {
                outline: none;
            }
            &:hover {
                outline: none;
            }
        }
        input[type=radio] + label{
            font-size: 18px;
            cursor: pointer;
            padding-left: 36px;
            position: relative;
        }
        input[id=normal] + label {
            font-weight: normal !important;
        }
        input[id=italic] + label {
            font-weight: normal !important;
            font-style: italic !important;
        }
        input[id=bold] + label {
            font-weight: bold !important;
        }
        input[id=b_italic] + label {
            font-weight: bold !important;
            font-style: italic !important;
        }
        input[type=radio]:checked + label{
            color: #000000;
            font-weight: bolder;
        }
        input[type=radio] + label:before{
            content: "";
            top: 3px;
            left: 0;
            width: 20px;
            height: 20px;
            position: absolute;
            background: #000;
            border-radius: 100%;
            transition: all 0.3s ease;
            box-shadow: inset 0 0 0 18px #fff;
        }
        input[type=radio]:checked + label:before{
            border: 2px solid #000;
            box-shadow: inset 0 0 0 3px #fff;
        }
        &.inverted {
            input[type=checkbox], input[type=radio] {
                border: 1px solid black;
                &:focus {
                    border: 1px solid darken(black, 5%);
                }
                &:checked {
                    background: black;
                }
            }
        }
    }
</style>

<script>
    export default {
        props: {
            name: {
                type: String,
                required: false
            },
            className: {
                type: String,
                required: false
            },
            id: {
                type: String,
                required: false
            },
            value: {
                type: String,
                required: false
            },
            required: {
                type: Boolean,
                required: false,
                default: false
            },
            checked: {
                type: Boolean,
                required: false
            },
            inverted: {
                type: Boolean,
                required: false,
                default: false
            },
            label: {
                type: String,
                required: true
            }
        },
        methods: {
            updateInput: function(event) {
                var val = event.target.value;
                this.$emit('input', val);
            }
        }
    }
</script>
