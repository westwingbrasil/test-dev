<template>
    <vc-col :width="width">
        <div class="form-box">
            <div class="form-box-label">{{ title }}</div>
            <div>
                <slot></slot>
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
            width: {default: 12}
        },

        components: {
            VcCol
        }
    }
</script>
<style scoped>
    .form-box {
        padding: 5px 20px 10px;
        border: 1px solid #eaeaea;
        margin-bottom: 18px;
    }
    .form-box-label {
        display: inline-block;
        margin-right: 25px;
        padding: 0 5px;
        background-color: #fff;
        position: relative;
        top: -15px;
    }
    .modal .form-box-label {
        background-color: rgb(248, 250, 251);
    }
</style>