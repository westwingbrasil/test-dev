<template>
    <vc-col :width="width">
        <label v-show="isAligned" class="control-label label-pad"></label>
        <div class="clearfix"></div>
        <button ref="button" :disabled="disabled" :class="btnClass" class="btn" type="button" :aligned="false">
            <i :class="btnIcon"></i>
            <slot>{{ btnText }}</slot>
        </button>
    </vc-col>
</template>

<script>

    import VcCol from './VcCol';

    export default {

        components: {
            VcCol
        },

        props: {
            text: String,
            icon: String,
            mode: String, // block, bitbucket, circle, inline
            type: String, // primary, default, warning, danger, info, success, link
            color: String, // primary, mutted, warning, danger, info, success
            disabled: {
                default: false,
                type: Boolean
            },
            template: String,
            size: String,
            width: {default: 3},
            aligned: null,
            noPadding: null
        },

        computed: {
            isAligned() {
                if (typeof this.aligned === 'boolean') {
                    return this.aligned;
                } else if (this.template) {
                    return this.templates[this.template].aligned;
                } else {
                    return true;
                }
            },
            btnClass() {
                let classes = {};
                // Mode
                classes[this.btnMode] = true;
                // Tipo
                classes[this.btnType] = true;
                // Cor de texto
                classes[this.btnColor] = true;
                // Tamanho
                classes[this.btnSize] = true;
                // No Padding
                classes['no-padding'] = this.btnNoPadding;

                return classes;
            },
            btnMode() {
                if (this.mode) {
                    return 'btn-' + this.mode;
                } else if (this.template) {
                    return 'btn-' + this.templates[this.template].mode;
                } else {
                    return 'btn-block';
                }
            },
            btnIcon() {
                if (this.icon) {
                    return this.icon;
                } else if (this.template) {
                    return this.templates[this.template].icon;
                } else {
                    return null;
                }
            },
            btnType() {
                if (this.type) {
                    return 'btn-' + this.type;
                } else if (this.template) {
                    return 'btn-' + this.templates[this.template].type;
                } else {
                    return 'btn-default';
                }
            },
            btnSize() {
                if (this.size) {
                    return 'btn-' + this.size;
                } else if (this.template) {
                    return 'btn-' + this.templates[this.template].size;
                } else {
                    return 'btn-md';
                }
            },
            btnText() {
                if (this.text) {
                    return this.text;
                } else if (this.template) {
                    return this.templates[this.template].text;
                } else {
                    return null;
                }
            },
            btnColor() {
                if (this.color) {
                    return 'text-' + this.color;
                } else if (this.template) {
                    return 'text-' + this.templates[this.template].color;
                } else {
                    return null;
                }
            },
            btnNoPadding() {
                if (typeof(this.noPadding) === "boolean") {
                    return this.noPadding;
                } else if (this.template) {
                    return this.templates[this.template].noPadding;
                } else {
                    return false;
                }
            }
        },

        mounted() {
        },

        data() {
            return {
                templates: {
                    'filtrar': {
                        text: 'Filtrar',
                        type: 'primary',
                        mode: 'block',
                        icon: 'fa fa-filter',
                        color: null,
                        size: 'md',
                        aligned: true,
                        noPadding: false
                    },
                    'limpar-filtros': {
                        text: 'Limpar filtros',
                        type: 'default',
                        mode: 'block',
                        icon: 'fa fa-eraser',
                        color: null,
                        size: 'md',
                        aligned: true,
                        noPadding: false
                    },
                    'processar': {
                        text: 'Processar',
                        type: 'primary',
                        mode: 'block',
                        icon: 'fa fa-check',
                        color: null,
                        size: 'md',
                        aligned: true,
                        noPadding: false
                    },
                    'cancelar': {
                        text: 'Cancelar',
                        type: 'default',
                        mode: 'block',
                        icon: '',
                        color: null,
                        size: 'md',
                        aligned: true,
                        noPadding: false
                    },
                    'gravar': {
                        text: 'Gravar',
                        type: 'primary',
                        mode: 'block',
                        icon: 'fa fa-floppy-o',
                        color: null,
                        size: 'md',
                        aligned: true,
                        noPadding: false
                    },
                    'limpar-tela': {
                        text: 'Limpar tela',
                        type: 'default',
                        mode: 'block',
                        icon: 'fa fa-eraser',
                        color: null,
                        size: 'md',
                        aligned: true,
                        noPadding: false
                    },
                    'novo': {
                        text: 'Novo',
                        type: 'default',
                        mode: 'block',
                        icon: 'fa fa-plus',
                        color: null,
                        size: 'md',
                        aligned: true,
                        noPadding: false
                    },
                    'editar': {
                        text: 'Editar',
                        type: 'primary',
                        mode: 'block',
                        icon: 'fa fa-edit',
                        color: null,
                        size: 'md',
                        aligned: true,
                        noPadding: false
                    },
                    'excluir': {
                        text: 'Excluir',
                        type: 'danger',
                        mode: 'block',
                        icon: 'fa fa-trash',
                        color: null,
                        size: 'md',
                        aligned: true,
                        noPadding: false
                    },
                    'download': {
                        text: 'Download',
                        type: 'default',
                        mode: 'block',
                        icon: 'fa fa-download',
                        color: null,
                        size: 'md',
                        aligned: true,
                        noPadding: false
                    },
                    'upload': {
                        text: 'Upload',
                        type: 'default',
                        mode: 'block',
                        icon: 'fa fa-upload',
                        color: null,
                        size: 'md',
                        aligned: true,
                        noPadding: false
                    },
                    'exportar-csv': {
                        text: 'Exportar CSV',
                        type: 'default',
                        mode: 'block',
                        icon: 'fa fa-file-text-o',
                        color: null,
                        size: 'md',
                        aligned: true,
                        noPadding: false
                    },
                    'exportar-xls': {
                        text: 'Exportar XLS',
                        type: 'default',
                        mode: 'block',
                        icon: 'fa fa-file-excel-o',
                        color: null,
                        size: 'md',
                        aligned: true,
                        noPadding: false
                    },
                    'exportar-pdf': {
                        text: 'Exportar PDF',
                        type: 'default',
                        mode: 'block',
                        icon: 'fa fa-file-pdf-o',
                        color: null,
                        size: 'md',
                        aligned: true,
                        noPadding: false
                    },
                    'exportar-zip': {
                        text: 'Exportar ZIP',
                        type: 'default',
                        mode: 'block',
                        icon: 'fa fa-file-zip-o',
                        color: null,
                        size: 'md',
                        aligned: true,
                        noPadding: false
                    },
                    'table-info': {
                        text: '',
                        type: 'primary',
                        mode: 'inline',
                        icon: 'fa fa-plus-circle',
                        color: null,
                        size: 'xs',
                        aligned: false,
                        noPadding: false
                    },
                    'table-editar': {
                        text: '',
                        type: 'link',
                        mode: 'inline',
                        icon: 'fa fa-edit',
                        color: 'success',
                        size: 'md',
                        aligned: false,
                        noPadding: true
                    },
                    'table-excluir': {
                        text: '',
                        type: 'link',
                        mode: 'inline',
                        icon: 'fa fa-trash',
                        color: 'danger',
                        size: 'md',
                        aligned: false,
                        noPadding: true
                    },
                    'confirmar': {
                        text: 'Confirmar',
                        type: 'primary',
                        mode: 'block',
                        icon: 'fa fa-check',
                        color: 'primary',
                        size: 'md',
                        aligned: true,
                        noPadding: false
                    },
                }
            }
        }
    }
</script>

<style scoped>
    .btn {
        margin-bottom: 0 !important;
    }
    .no-padding {
        padding: 0 !important;
    }
    .inline-cont {
        display: inline-block !important;
    }
    label.label-pad {
        min-height: 1.3em !important;
        margin-bottom: 5px !important;
        display: block;
    }
</style>
