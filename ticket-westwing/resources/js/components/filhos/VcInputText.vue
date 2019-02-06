<template>
    <input :autofocus="focus" :required="required" :disabled="disabled" :maxlength="maxlength" type="text"
           ref="input" class="form-control" :value="value" @input="updateValue" v-vd-mask:object="maskObj()"
           :placeholder="placeholder">
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
            maxlength: {
                type: Number,
                default: 250
            },
            uppercase: {
                type: Boolean,
                default: true,
            },
            placeholder: String,
            normalize: {
                default: true,
                type: Boolean
            },
            mask: Object
        },

        methods: {
            updateValue() {
                if (this.normalize) {
                    this.$refs.input.value = this.$refs.input.value.normalize('NFD').replace(/[\u0300-\u036f]/g, "");
                }
                if (this.uppercase) {
                    this.$refs.input.value = this.$refs.input.value.toUpperCase();
                }
                this.$emit('input', this.$refs.input.value);
            },

            maskObj() {
                return this.mask ? this.mask : {ignore: true}
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