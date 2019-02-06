<template>
    <vc-col :width="width" :classes="classes">
        <label v-if="aligned || label" class="control-label">{{ label }}</label>
        <div class="input-range">
            <div class="input-range-item">
                <slot name="first"></slot>
            </div>
            <div class="text-center input-range-center">
                a
            </div>
            <div class="input-range-item">
                <slot name="second"></slot>
            </div>
        </div>
    </vc-col>
</template>

<script>
    import VcCol from './VcCol';

    export default {
        props: {
            // Props padrão
            label: String,
            width: {default: 12},
            group: {
                default: true,
                type: Boolean
            },
            aligned: {
                default: true,
                type: Boolean
            }
        },
        computed: {
            classes() {
                return this.group ? ['form-group'] : [];
            }
        },
        components: {
            VcCol
        }
    }
</script>

<style scoped>
    .input-range-item {
        float: left;
        width: calc(50% - 13px);
        display: inline-block;
        vertical-align: top;
        font-size: 15px;
    }
    .input-range-center {
        float: left;
        width: 26px;
        display: inline-block;
        height: 34px;
        line-height: 34px;
        border-top: 1px solid #e5e6e7;
        border-bottom: 1px solid #e5e6e7;
    }
    .input-range {
        display: block;
        width: 100%;
    }
</style>