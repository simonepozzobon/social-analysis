<template lang="html">
    <panel title="Twitter">
        <div class="stats d-flex justify-content-center w-100">
            <h4 v-if="this.competitor">
                <span class="text-muted small">Un post ogni </span>
                {{ stats }}
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
    props: {
        competitor: {
            type: Object,
            default: function() {},
        }
    },
    data: function() {
        return {}
    },
    computed: {
        stats: function() {
            return this.competitor.twitter_profiles[0].stats.toFixed(2)
        }
    },
    methods: {
        getTweets: function() {
            if (this.competitor) {
                this.$http.get('/api/twitter/get-tweets/'+this.competitor.id)
            }
        }
    },
    mounted: function() {
        this.getTweets()
    }
}
</script>

<style lang="css">
</style>
