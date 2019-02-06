<template>
    <div>
        <label class="control-label input-label">
            <input type="radio" :autofocus="focus" :required="required" :name="name" :disabled="disabled" class="i-checks"
                   ref="input" :value="val">
            {{ label }}
        </label>
    </div>
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
            label: String,
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
            name: String,
            val: String
        },

        mounted() {
            this.input = this.$refs.input;

            $(this.input).on('ifChanged', () => {
                this.$emit('input', this.input.value);
            });
        },

        watch: {
            value(val) {
                if (val === this.$refs.input.value) {
                    $(this.$refs.input).iCheck('check');
                } else {
                    $(this.$refs.input).iCheck('uncheck');
                }
            },
            disabled(val) {
                $(this.input).prop('disabled', val).iCheck('update');
            }

        }
    }
</script>
<style scoped>
    label.control-label.input-label {
        margin-bottom: 0;
        width: 100%;
    }
</style>