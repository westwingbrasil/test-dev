<template>
    <div class="modal fade" id="modalDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{ title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
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
            title: { type: String, required: true },
        },
    }
</script>

<style scoped>

</style>