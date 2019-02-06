<template>
    <div class="upload-btn-wrapper">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-paperclip"></i></span>
            <input type="text" class="form-control" :value="filename" :disabled="disabled" :placeholder="placeholder">
        </div>
        <input ref="input" :autofocus="focus" :disabled="disabled" :required="required" :multiple="multi" :accept="accept"
               type="file" class="form-control col-md-4 input-real" @input="updateFile">
    </div>
</template>

<script>

    export default {

        data() {
            return {
                filename: null,
                input: null
            }
        },

        props: {
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
            accept: String,
            placeholder: String,
            maxFileSize: {
                type: Number,
                default: 3024000
            }

        },

        methods: {
            updateFile: function (e) {
                let filename = '';
                $.each(this.$refs.input.files, (i,v) => {
                    if (v.size > this.maxFileSize) {
                        this.$refs.input.value = null;
                        Event.$emit('VcAlert', {
                            type: 'warning',
                            title: this.$i18n.t('Arquivo'),
                            text: this.$i18n.t('O arquivo não pode exceder ' + this.mbMaxFileFize + ' mb(s).')
                        });
                        return;
                    }
                    if (i !== 0) {
                        filename += ', ';
                    }
                    filename += v.name;
                });
                this.filename = filename;
                if (this.multi) {
                    this.$emit('input', this.$refs.input.files);
                } else {
                    this.$emit('input', this.$refs.input.files[0]);
                }
            },

            formatNumber(data) {
                if (!data || parseFloat(data) === 0.0) {
                    return '0';
                }
                return parseFloat(data).toLocaleString('pt-BR', {
                    style: 'decimal',
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 2,
                })
            }
        },

        computed: {
            buttonText() {
                if (this.multi) {
                    return 'Upload de arquivos';
                } else {
                    return 'Upload de arquivo';
                }
            },

            mbMaxFileFize() {
                return this.formatNumber(this.maxFileSize / 1000000);
            }
        },

        mounted() {
            this.input = this.$refs.input;
        }
    }
</script>
<style scoped>
    .upload-btn-wrapper {
        position: relative;
        overflow: hidden;
        display: block;
        width: 100%;
    }

    .input-group {
        width: 100%;
    }

    .input-real {
        font-size: 100px;
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
        z-index: 10;
    }

</style>