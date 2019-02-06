<template>
    <select ref="input" :disabled="disabled" class="form-control" :multiple="multi" :required="required">
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
            multi: {
                type: Boolean,
                default: false
            },
            apiUrl: String,
            optionValue: String,
            optionText: Array,
            additionalParams: Object,
            tags: {
                type: Boolean,
                default: false
            },
            sort: String
        },

        mounted() {
            // Instancia o select2
            this.criaSelect2();
            if (this.value) {
                this.requestVal(this.value);
            }
            this.input = this.$refs.input;
        },

        watch: {
            value(value) {
                this.requestVal(value);
            }
        },
        
        methods: {
            criaSelect2(){

                // Opções do select2
                let options = {
                    placeholder: 'Selecione...',
                    allowClear: true,
                    minimumResultsForSearch: 6,
                    tags: this.tags, 
                    dropdownAutoWidth: false,
                    language: {
                        errorLoading: function () {
                            return 'Os resultados não puderam ser carregados...';
                        },
                        noResults: function () {
                            return 'Nenhum resultado encontrado...';
                        },
                        searching: function () {
                            return 'Buscando...';
                        }
                    },
                    ajax: {
                        method: 'get',
                        url: this.apiUrl,
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': `Bearer ${window.Laravel.userToken}`
                        },
                        dataType: 'json',
                        data: this.select2Data,
                        processResults: this.select2ProcessResults
                    },
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
            },

            select2Data(params) {
                let query = {
                    page: params.page || 1,
                    perPage: 100,
                    select: 1,
                    vueComp: 1
                };

                // Adiciona os parâmetros adicionais na query
                if (this.additionalParams) {
                    query.filters = this.additionalParams;
                }

                // Adiciona qualquer valor digitado na query
                if (params.hasOwnProperty('term')) {
                    query.search = params.term;
                    query.searchColumns = [this.optionValue];
                    if (this.optionText) {
                        query.searchColumns = query.searchColumns.concat(this.optionText);
                    }
                }

                // Adiciona parêmetro de ordenação
                if (this.sort) {
                    query.sort = this.sort;
                }

                return query;
            },

            select2ProcessResults(data, params) {
                params.page = params.page || 1;

                let results = [];

                data.results.forEach((result) => {

                    // Monta o valor da opção de acordo com a prop [optionText]
                    let text = '';
                    if (this.optionText) {
                        $.each(this.optionText, function (i, e) {
                            text += ' - ' + result[e];
                        });
                        text = text.replace(' - ', '');
                    } else {
                        text = result[this.optionValue];
                    }

                    results.push({
                        id: result[this.optionValue],
                        text: text
                    });
                });

                return {
                    results: results,
                    pagination: {
                        more: (params.page * data.perPage) < data.total
                    }
                };
            },

            requestVal(val) {

                if (!val) {
                    $(this.$refs.input).val(null).change();
                    return;
                }
                
                if(val === $(this.$refs.input).val()) {
                    return;
                }

                let params = {
                    page: 1,
                    perPage: 100,
                    select: 1,
                    vueComp: 1
                };

                // Adiciona o valor requisitado
                params.search = val;
                params.searchColumns = [this.optionValue];

                // Adiciona os parâmetros adicionais na query
                if (this.additionalParams) {
                    params.filters = this.additionalParams;
                }

                // Adiciona parâmetro de ordenação
                if (this.sort) {
                    params.sort = this.sort;
                }

                Event.$emit('VcLoader', true);
                this.loading(true);
                axios({
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': `Bearer ${window.Laravel.userToken}`
                    },
                    method: 'get',
                    url: this.apiUrl,
                    params: params
                })
                    .then((response) => {
                        if (response.data && response.data.total) {
                            let count = 1;
                            $.each(response.data.results, (ind, data) => {
                                // Monta o valor da opção de acordo com a prop [optionText]
                                let text = '';
                                if (this.optionText) {
                                    $.each(this.optionText, function (i, e) {
                                        text += ' - ' + data[e];
                                    });
                                    text = text.replace(' - ', '');
                                } else {
                                    text = data[this.optionValue];
                                }

                                // Faz o append da nova opção
                                let option = new Option(text, data[this.optionValue]);
                                $(this.$refs.input).append(option);

                                // Seleciona a primeira opção
                                if (count === 1) {
                                    $(this.$refs.input).val(data[this.optionValue]);
                                }
                                count++;
                            });
                            $(this.$refs.input).change();
                            Event.$emit('VcLoader', false);
                            this.loading(false);
                        } else {
                            $(this.$refs.input).val(null).change();
                            Event.$emit('VcLoader', false);
                            this.loading(false);
                        }
                    })
                    .catch(err => {
                        Event.$emit('VcLoader', false);
                        this.loading(false);
                        Event.$emit('VcAlert', {
                            title: 'Falha',
                            text: 'Houve uma falha na atualização do select!',
                            notificationStatus: 'error'
                        });
                    });
            },

            loading(loading) {
                this.$emit('loading', loading);
            }
        }
    }
</script>
<style scoped>
    .modal .select2-container {
        z-index: 9999;
        width: 100% !important;
    }
</style>
