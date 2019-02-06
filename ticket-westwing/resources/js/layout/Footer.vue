<template>
    <div>
        <div class="footer" :class="{ fixed: this.fixed }">
            <div class="pull-right">
                <strong>Versão:</strong> {{ version }}
            </div>
            <div>
                <strong>Copyright</strong> Westwing Brasil. &copy; 2019
            </div>

        </div>
    </div>
</template>

<script>

export default {

    data() {

    },
    
    props: {
        fixed: Boolean,
        version: String
    },

    computed: {
        window() {
            return window;
        }
    },
}
</script>

<style scoped>
#easter:hover {
    font-weight: bold
}
</style>
