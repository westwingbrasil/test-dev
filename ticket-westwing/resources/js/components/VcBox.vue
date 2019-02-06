<template>
    <vc-col :width="width">
        <div class="ibox float-e-margins">
            <div v-if="title" class="ibox-title col-md-12">
                <vc-col :width="9" class="title-text">
                    {{ title }}
                </vc-col>
                <div class="ibox-tools">
                    <a class="collapse-link" v-show="collapse">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <slot></slot>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </vc-col>
</template>

<script>
    import VcCol from './VcCol';

    export default {

        props: {
            title: String,
            collapse: {
                type: Boolean,
                default: true
            },
            width: {default: 12}
        },
        components: {
            VcCol
        }
    }

</script>

<style scoped>
    .ibox-content {
        padding-top: 30px;
    }
    .title-text {
        font-weight: bold;
    }
</style>
