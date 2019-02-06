<template>
    <div :class="classesArray" :style="style">
        <slot></slot>
        <div class="clearfix"></div>
    </div>
</template>

<script>
    export default {

        props: {
            width: {default: 12},
            classes: Array
        },

        computed: {
            classesArray() {
                let classes = [];
                if (this.width && typeof this.width === 'number') {
                    classes.push('col-md-' + this.width);
                } else if (this.width && this.width === 'inline') {
                    classes.push('inline');
                }
                classes = classes.concat(this.classes);
                return classes;
            },
            style() {
                if (this.width && typeof this.width === 'string' && this.width !== 'inline') {
                    return { width: this.width }
                }
            }
        }
    }

</script>

<style scoped>
    .inline {
        display: inline-block !important;
    }
</style>
