<template>
    <select ref="input" :autofocus="focus" :disabled="disabled" class="form-control"
            :multiple="multi" :required="required">
        <option value="">Selecione...</option>
    </select>
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
            data: Array,
            multi: {
                type: Boolean,
                default: false
            },
            tags: {
                type: Boolean,
                default: false
            }
        },

        mounted() {
            // Instancia o select2
            this.criaSelect2();
            if (this.value) {
                $(this.$refs.input).val(this.value).change();
            }
            this.input = this.$refs.input;
        },

        watch: {
            value(value) {
                $(this.$refs.input).val(value).change();
            },
            data(value) {
                $(this.$refs.input).html('');
                this.criaSelect2();
            }
        },
        
        methods: {
            criaSelect2() {

                // Opções do select2
                let options = {
                    placeholder: 'Selecione...',
                    allowClear: true,
                    minimumResultsForSearch: 6,
                    tags: this.tags,
                    dropdownAutoWidth: false,
                    data: this.data,
                    createTag: function (params) {
                        let term = $.trim(params.term);
                        return {
                            id: term,
                            text: term,
                            newTag: true
                        }
                    },
                };

                // Inicia a instância
                $(this.$refs.input)
                    .select2(options)
                    .on('change', () => {
                        this.$emit('input', $(this.$refs.input).val());
                    });
            }
        }
    }
</script>
<style scoped>
    .modal .select2-container {
        z-index: 9999;
        width: 100% !important;
    }
    .form-control {
        width: 100% !important;
    }
</style>