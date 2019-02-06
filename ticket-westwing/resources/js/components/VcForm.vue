<template>
    <form ref="form" @submit.prevent="" :enctype="multipart ? 'multipart/form-data' : ''" method="post">
        <slot></slot>
    </form>
</template>

<script>
export default {

    data() {
        return {
            form: null
        }
    },
    props: {
        multipart: {
            type: Boolean,
            default: true
        }
    },
    mounted() {
        this.form = this.$refs.form;
    }
}
</script>