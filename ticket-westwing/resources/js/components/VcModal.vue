<template>
    <div ref="modal" class="modal inmodal" role="dialog" aria-hidden="true">
        <div class="modal-dialog" :class="`modal-${size}`">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title">{{ title }}</h4>
                </div>
                <div class="modal-body">
                    <slot name="body">
                    </slot>
                </div>
                <div class="modal-footer">
                    <slot name="footer">
                    </slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {

    props: {
        title: {
            required: true,
            type: String
        },
        size: {
            default: 'md',
            type: String
        }
    },

    methods: {
        show() {
            $(this.$refs.modal).modal('show');
        },
        hide() {
            $(this.$refs.modal).modal('hide');
        }
    },

    mounted() {

        $(this.$refs.modal).on('shown.bs.modal', function () {
            $('input[autofocus]').focus();
        });

   }
}
</script>

<style scoped>
.modal-body {
    max-height: calc(100vh - 250px);
    overflow-y: auto;
}
</style>
