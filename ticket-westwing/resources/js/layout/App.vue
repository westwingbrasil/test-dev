<template>
    <div>
        <div id="page-wrapper" class="gray-bg">

            <div class="wrapper wrapper-content">
                <slot></slot>
                <div class="clearfix"></div>
            </div>

            <west-footer :fixed="true" :version="2019.1"></west-footer>

            <vc-alert></vc-alert>
            <div class="clearfix"></div>

            <div id="loading" class="sk-loading">
                <div class="sk-spinner sk-spinner-wave">
                    <div class="sk-rect1"></div>
                    <div class="sk-rect2"></div>
                    <div class="sk-rect3"></div>
                    <div class="sk-rect4"></div>
                    <div class="sk-rect5"></div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

    import VcAlert from '../components/VcAlert.vue';

    export default {
        data() {
            return {
                VcLoaderCount: 1 // começa com 1, com o VcLoader acionado
            }
        },

        beforeMount() {
            Event.$on('VcLoader', data => {
                if (data) {
                    this.VcLoaderCount++;
                } else {
                    this.VcLoaderCount--;
                }
            });
        },

        watch: {
            VcLoaderCount() {
                if (this.VcLoaderCount > 0) {
                    $('#loading').addClass('sk-loading');
                } else {
                    this.VcLoaderCount = 0;
                    $('#loading').removeClass('sk-loading');
                }
            }
        },

        components: {
            VcAlert
        }
    }
</script>

<style scoped>
    .wrapper-content {
        position: relative;
    }
    #loading {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        width: 100vw;
        background-color: rgba(255,255,255,0.80);
        z-index: 99999999;
    }
    #loading.sk-loading {
        display: block;
    }
    .sk-spinner {
        position: fixed !important;
        top: 45vh !important;
        width: 100% !important;
    }
</style>
