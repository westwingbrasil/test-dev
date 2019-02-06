<template>
    <vc-col :width="width" :classes="classes">
        <label v-if="aligned" class="control-label main-label"></label>
        <label v-else-if="label && type !== 'checkbox' && type !== 'radio'" class="control-label main-label">{{ label }}</label>

        <div v-if="type === 'checkbox'">
            <vc-checkbox
                    ref="input"
                    :label="label"
                    :focus="focus"
                    :required="required"
                    :disabled="disabled"
                    :value="value"
                    @input="updateValue">
            </vc-checkbox>
        </div>

        <div v-else-if="type === 'date'">
            <vc-input-date
                    ref="input"
                    :focus="focus"
                    :required="required"
                    :disabled="disabled"
                    :date-type="dateType"
                    :value="value"
                    :convert="convert"
                    @input="updateValue">
            </vc-input-date>
        </div>

        <div v-else-if="type === 'file'">
            <vc-input-file
                    ref="input"
                    :focus="focus"
                    :required="required"
                    :disabled="disabled"
                    :accept="accept"
                    :multi="multi"
                    :placeholder="placeholder"
                    :value="value"
                    :max-file-size="maxFileSize"
                    @input="updateValue">
            </vc-input-file>
        </div>

        <div v-else-if="type === 'number'">
            <vc-input-number
                    ref="input"
                    :focus="focus"
                    :required="required"
                    :disabled="disabled"
                    :prefix="prefix"
                    :decimal="decimal"
                    :marks="marks"
                    :radix="radix"
                    :value="value"
                    :unmask="unmask"
                    @input="updateValue">
            </vc-input-number>
        </div>

        <div v-else-if="type === 'currency'">
            <div class="input-group">
                <span class="input-group-addon">R$</span>
                <vc-input-number
                        ref="input"
                        :focus="focus"
                        :required="required"
                        :disabled="disabled"
                        :prefix="prefix"
                        :decimal="decimal ? decimal : 2"
                        :marks="marks ? marks : '.'"
                        :radix="radix ? radix : ','"
                        :value="value"
                        :unmask="unmask"
                        @input="updateValue">
                </vc-input-number>
            </div>
        </div>

        <div v-else-if="type === 'percent'">
            <div class="input-group">
                <span class="input-group-addon">%</span>
                <vc-input-number
                        ref="input"
                        :focus="focus"
                        :required="required"
                        :disabled="disabled"
                        :prefix="prefix"
                        :decimal="decimal"
                        :marks="marks"
                        :radix="radix"
                        :value="value"
                        :unmask="unmask"
                        @input="updateValue">
                </vc-input-number>
            </div>
        </div>

        <div v-else-if="type === 'text'">
            <vc-input-text
                    ref="input"
                    :focus="focus"
                    :required="required"
                    :disabled="disabled"
                    :uppercase="uppercase"
                    :placeholder="placeholder"
                    :maxlength="maxlength"
                    :normalize="normalize"
                    :mask="mask"
                    :value="value" @input="updateValue">
            </vc-input-text>
        </div>

        <div v-else-if="type === 'cpf'">
            <vc-input-text
                    ref="input"
                    :focus="focus"
                    :required="required"
                    :disabled="disabled"
                    v-vd-mask:cpf="directiveObj"
                    :value="value"
                    @input="updateValue">
            </vc-input-text>
        </div>

        <div v-else-if="type === 'cnpj'">
            <vc-input-text
                    ref="input"
                    :focus="focus"
                    :required="required"
                    :disabled="disabled"
                    v-vd-mask:cnpj="directiveObj"
                    :value="value"
                    @input="updateValue">
            </vc-input-text>
        </div>

        <div v-else-if="type === 'cpfcnpj'">
            <vc-input-text
                    ref="input"
                    :focus="focus"
                    :required="required"
                    :disabled="disabled"
                    v-vd-mask:cpfcnpj="directiveObj"
                    :value="value"
                    @input="updateValue">
            </vc-input-text>
        </div>

        <div v-else-if="type === 'celtel'">
            <vc-input-text
                    ref="input"
                    :focus="focus"
                    :required="required"
                    :disabled="disabled"
                    v-vd-mask:celtel="directiveObj"
                    :value="value"
                    @input="updateValue">
            </vc-input-text>
        </div>

        <div v-else-if="type === 'cep'">
            <vc-input-text
                    ref="input"
                    :focus="focus"
                    :required="required"
                    :disabled="disabled"
                    v-vd-mask:cep="directiveObj"
                    :value="value"
                    @input="updateValue">
            </vc-input-text>
        </div>

        <div v-else-if="type === 'radio'">
            <vc-radio-button
                    ref="input"
                    :label="label"
                    :focus="focus"
                    :required="required"
                    :disabled="disabled"
                    :name="name"
                    :value="value"
                    :val="val"
                    @input="updateValue">
            </vc-radio-button>
        </div>

        <div v-else-if="type === 'select' && !apiUrl">
            <vc-select
                    ref="input"
                    :focus="focus"
                    :required="required"
                    :disabled="disabled"
                    :multi="multi"
                    :tags="tags"
                    :data="data"
                    :value="value"
                    @input="updateValue">
            </vc-select>
        </div>

        <div v-else-if="type === 'select' && apiUrl">
            <vc-select-api
                    ref="input"
                    :focus="focus"
                    :required="required"
                    :disabled="disabled"
                    :multi="multi"
                    :api-url="apiUrl"
                    :option-value="optionValue"
                    :option-text="optionText"
                    :additional-params="additionalParams"
                    :tags="tags"
                    :sort="sort"
                    :value="value"
                    @input="updateValue"
                    @loading="loading">
            </vc-select-api>
        </div>

        <div v-else-if="type === 'textarea'">
            <vc-textarea
                    ref="input"
                    :focus="focus"
                    :required="required"
                    :disabled="disabled"
                    :uppercase="uppercase"
                    :placeholder="placeholder"
                    :maxlength="maxlength"
                    :value="value"
                    :normalize="normalize"
                    @input="updateValue">
            </vc-textarea>
        </div>

        <span v-if="group" class="text-danger"></span>
    </vc-col>
</template>

<script>

    import VcCheckbox from './filhos/VcCheckbox.vue';
    import VcInputDate from './filhos/VcInputDate.vue';
    import VcInputFile from './filhos/VcInputFile.vue';
    import VcInputNumber from './filhos/VcInputNumber.vue';
    import VcInputText from './filhos/VcInputText.vue';
    import VcRadioButton from './filhos/VcRadioButton.vue';
    import VcSelect from './filhos/VcSelect.vue';
    import VcSelectApi from './filhos/VcSelectApi.vue';
    import VcTextarea from './filhos/VcTextarea.vue';
    import VcCol from './VcCol';

    export default {

        components: {
            VcCheckbox,
            VcInputDate,
            VcInputFile,
            VcInputNumber,
            VcInputText,
            VcRadioButton,
            VcSelect,
            VcSelectApi,
            VcTextarea,
            VcCol
        },

        data() {
            return {
                input: null,
            }
        },

        props: {

            // Props padrão
            value: null,
            label: String,
            width: {default: 12},
            group: {
                default: true,
                type: Boolean
            },
            focus: {
                type: Boolean,
                default: false
            },
            required: {
                type: Boolean,
                default: false
            },
            disabled: {
                type: Boolean,
                default: false
            },
            type: {
                default: 'text',
                type: String
            },
            model: null,
            placeholder: String,

            // Opcionais
            name: String,
            data: Array,
            uppercase: {
                type: Boolean,
                default: true,
            },
            dateType: {
                type: String,
                default: 'day'
            },
            maxlength: {
                type: Number,
                default: 100
            },
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
            aligned: {
                default: false,
                type: Boolean
            },
            accept: String,
            mask: Object,

            prefix: String,
            decimal: Number,
            marks: String,
            radix: String,
            sort: String,
            unmask: {
                type: Boolean,
                default: true
            },
            convert: {
                type: Boolean,
                default: true
            },
            normalize: {
                default: true,
                type: Boolean
            },
            val: String,
            maxFileSize: {
                type: Number,
                default: 3024000
            }
        },

        computed: {
            directiveObj() {
                return {
                    unmask: this.unmask,
                }
            },
            classes() {
                let classes = [];
                if (this.group) {
                    classes.push('form-group');
                }
                return classes;
            }
        },

        methods: {
            updateValue(value) {
                this.$emit('input', value);
            },

            loading(loading) {
                this.$emit('loading', loading);
            }
        },

        mounted() {
            this.input = this.$refs.input.input;
        }

    }

</script>

<style scoped>
    label.main-label {
        min-height: 1.3em !important;
        margin-bottom: 5px !important;
        display: block;
    }
</style>