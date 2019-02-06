<template>
    <div ref="datePickerGroup" class="input-group date">
        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        <input :autofocus="focus" :required="required" :disabled="disabled" type="text"
               ref="input" class="form-control" v-vd-mask:date="directiveObj" :value="convValue">
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
            dateType: {
                type: String,
                default: 'day'
            },
            convert: {
                type: Boolean,
                default: true
            }
        },

        computed: {
            directiveObj() {
                return {
                    dateType: this.dateType
                }
            },
            convValue() {
                if (this.value) {
                    if (this.dateType === 'month') {
                        return moment(this.value).format('MM/YYYY');
                    } else if (this.dateType === 'year') {
                        return moment(this.value).format('YYYY');
                    } else {
                        return moment(this.value).format('DD/MM/YYYY');
                    }
                }
            }
        },

        mounted() {
            // Datepicker
            $(this.$refs.datePickerGroup).datepicker({
                format: this.dateType === 'month' ? 'mm/yyyy' : this.dateType === 'year' ? 'yyyy' : 'dd/mm/yyyy',
                minViewMode: this.dateType === 'month' ? 1 : this.dateType === 'year' ? 2 : 0,
                language: 'pt-BR',
                autoclose: true,
                todayHighlight: true,
                todayBtn: "linked",
            }).on('hide', () => {
                this.updateValue();
            });
            this.input = this.$refs.input;
        },

        methods: {
            updateValue() {
                let value = this.$refs.input.value.split('/').reverse().join('-');
                this.$emit('input', value);
            }
        }
    }
</script>
<style scoped>
    input {
        text-align: center;
    }
    .form-control {
        width: 100% !important;
    }
</style>