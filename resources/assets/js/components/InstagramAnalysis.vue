<template lang="html">
    <panel title="Instagram">
        <div class="stats d-flex justify-content-center w-100">
            <!-- <h4 v-if="this.competitor">
                <span class="text-muted small">Un post ogni </span>
                {{ stats }}
                <span class="text-muted small">gg</span>
            </h4> -->
        </div>
    </panel>
</template>

<script>
import Panel from './ui/Panel.vue'
import axios from 'axios'

export default {
    name: 'InstagramAnalysis',
    components: {
        Panel,
    },
    methods: {
        getFeed: function() {
            // axios.get('https://www.instagram.com/shraddhakapoor/?__a=1').then(response => {
            //     console.log(response)
            // })
        },
    },
    mounted: function() {
        this.getFeed()
    }
}
</script>

<style lang="css">
</style>
