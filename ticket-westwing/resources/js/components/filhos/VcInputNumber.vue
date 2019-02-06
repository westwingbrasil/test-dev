<template>
    <input :autofocus="focus" :required="required" :disabled="disabled" type="text" class="form-control"
           ref="input" v-vd-mask:number="directiveObj" @change="updateValue" :value="value">
</template>

<script>

    export default {

        data() {
            return {
                input: null
            }
        },

        props: {
            value: null,
            disabled: {
                default: false,
                type: Boolean
            },
            required: {
                default: false,
                type: Boolean
            },
            focus: {
                default: false,
                type: Boolean
            },

            // Específicas
            prefix: {
                type: String,
                default: ''
            },
            decimal: {
                type: Number,
                default: 0
            },
            marks: {
                type: String,
                default: '',
            },
            radix: {
                type: String,
                default: ','
            },
            unmask: {
                type: Boolean,
                default: true
            }
        },

        computed: {
            directiveObj() {
                return {
                    prefix: this.prefix,
                    decimal: this.decimal,
                    marks: this.marks,
                    radix: this.radix,
                    unmask: this.unmask
                }
            }
        },

        methods: {
            updateValue() {
                let value = this.$refs.input.value;
                if (this.unmask) {
                    value = Number(value.replace(',', '.'));
                }
                this.$emit('input', value);
            }
        },

        mounted() {
            this.input = this.$refs.input;
        }
    }
</script>

<style scoped>
    .form-control {
        width: 100% !important;
    }
</style>