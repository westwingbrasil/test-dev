<template>
    <div>
        <ul class="nav nav-tabs">
            <li v-for="tab, i in tabs" :class="i === 0 ? 'active' : ''" role="presentation">
                <a :href="'#tab' + (i+1)" data-toggle="tab">{{ tab }}</a>
            </li>
        </ul>

        <div class="tab-content">
            <div v-for="i in tabs.length" :id="'tab' + i" :class="['tab-pane', i === 1 ? 'active' : '']">
                <vc-col :width="12">
                    <slot :name="'tab' + i"></slot>
                </vc-col>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</template>

<script>

    import VcCol from './VcCol';

    export default {

        data() {
            return {};
        },
        props: {
            tabs: {
                type: Array,
                required: true
            }
        },
        components: {
            VcCol
        }
    }

</script>

<style scoped>
    .tab-pane {
        padding: 15px 0 0;
    }
</style>
