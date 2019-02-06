<template>
    <vc-col :classes="['comp-container']" :width="width">
        <label v-if="aligned" class="control-label main-label"></label>
        <div class="square" :style="style"></div>
        <div v-if="text" class="text" :style="textStyle">{{ text }}</div>
    </vc-col>
</template>

<script>

    import VcCol from './VcCol';

    export default {

        data() {
            return {};
        },
        computed: {
            style() {
                return {
                    backgroundColor: this.color,
                    width: this.size,
                    height: this.size,
                    marginRight: '3px'
                };
            },
            textStyle() {
                return {
                    maxWidth: 'calc(100% - ' + this.size + ' - 15px)'
                }
            }
        },
        props: {
            color: {
                type: String,
                required: true
            },
            size: {
                type: String,
                default: '20px'
            },
            text: String,
            width: 12,
            aligned: {
                default: false,
                type: Boolean
            },
        },
        components: {
            VcCol
        }
    }

</script>

<style scoped>
    .comp-container div.square {
        display: inline-block;
        vertical-align: top;
        position: relative;
        top: -1px;
    }

    .comp-container div.text {
        display: inline-block;
        vertical-align: top;
    }
    .comp-container {
        margin-bottom: 5px;
    }
    label.main-label {
        min-height: 1.3em !important;
        margin-bottom: 5px !important;
        display: block;
    }
</style>
