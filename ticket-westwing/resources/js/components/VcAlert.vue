<template>
</template>

<script>

    import swal from 'sweetalert2';

    export default {

        /**
         * Opções:
         * mode: String (notification*, alert)
         * type: String (success*, error, warning, info, question)
         * caseConfirm: Function
         * caseCancel: Function
         * title: String
         * text: String
         * confirmButtonText: String
         * cancelButtonText: String
         * dangerMode: Boolean
         */

            mounted() {

            Event.$on('VcAlert', data => {

                // Padrão
                if(!data.mode) {
                    data.mode = 'notification'
                }

                // Modo ALERT - Sweetalert2
                if(data.mode === 'alert') {

                    // Chama o alert
                    swal(this.alertOptions(data))
                        .then((result) => {
                            if(result.value) {
                                if (data.caseConfirm) {
                                    data.caseConfirm();
                                }
                            } else {
                                if (data.caseCancel) {
                                    data.caseCancel();
                                }
                            }
                        });

                // Modo NOTIFICATION - Toastr
                } else {
                    let title = data.title ? data.title : null;
                    let status = data.type ? data.type : 'success';

                    toastr[status](data.text, title);
                }

            });
        },

        methods: {

            // Constrói as opções do alert
            alertOptions(data) {
                let options = {
                    reverseButtons: true
                };

                if (data.title) {
                    options.title = data.title;
                }
                if (data.text) {
                    options.text = data.text;
                }
                if (data.type) {
                    options.type = data.type;
                }
                if (data.confirmButtonText) {
                    options.confirmButtonText = data.confirmButtonText;
                } else {
                    options.confirmButtonText = 'Ok';
                }
                if (data.cancelButtonText) {
                    options.showCancelButton = true;
                    options.cancelButtonText = data.cancelButtonText;
                }
                if (data.dangerMode) {
                    options.confirmButtonColor = '#d33';
                }

                return options;
            }
        }
    }
</script>

<style>
    .swal2-popup {
        font-size: 1.5rem !important;
    }
</style>