<template lang="html">
    <panel title="Facebook">
        <button class="btn btn-primary" @click="getID">Get ID</button>
    </panel>
</template>

<script>
import EventBus from '../EventBus'
import Panel from './ui/Panel.vue'
export default {
    name: 'FacebookAnalysis',
    components: {
        Panel
    },
    props: {
        fb_token: {
            type: String,
            default: null,
        },
    },
    methods: {
        getID: function() {
            // console.log(FB)
            // if (this.fb_token) {
            //     var url = 'https://www.facebook.com/rareartlabs'
            //
            //     var data = new FormData()
            //     data.append('fb_token', this.fb_token)
            //     data.append('pageUrl', url)
            //
            //     this.$http.post('/api/get_facebook_id', data).then(response => {
            //         console.log(response)
            //     })
            // }
        }
    },
    mounted: function() {

    }
}
</script>

<style lang="scss">
</style>
