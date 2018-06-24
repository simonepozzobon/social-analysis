<template lang="html">
    <panel title="Twitter">
        <div class="stats d-flex justify-content-center w-100">
            <h4 v-if="this.competitor">
                <span class="text-muted small">Un post ogni </span>
                {{ competitor.stats }}
                <span class="text-muted small">gg</span>
            </h4>
        </div>
        <div class="btn-group">
            <button class="btn btn-primary" @click="getTweets">Grab Posts</button>
        </div>
    </panel>
</template>

<script>
import Panel from './ui/Panel.vue'
export default {
    name: 'TwitterAnalysis',
    components: {
        Panel,
    },
    data: function() {
        return {
            competitor: null,
            pageID: null,
            posts: [],
        }
    },
    methods: {
        getTweets: function() {
            
        }
    },
    mounted: function() {

    }
}
</script>

<style lang="css">
</style>
