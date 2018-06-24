<template lang="html">
    <panel title="Facebook">
        <div class="stats d-flex justify-content-center w-100">
            <h4 v-if="this.competitor">
                <span class="text-muted small">Un post ogni </span>
                {{ competitor.stats }}
                <span class="text-muted small">gg</span>
            </h4>
        </div>
        <div class="btn-group">
            <button class="btn btn-primary" @click="grabPosts">Grab Posts</button>
        </div>
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
        competitor_id: {
            type: Number,
            default: 1,
        },
        fb_token: {
            type: String,
            default: null,
        },
    },
    data: function() {
        return {
            competitor: null,
            pageID: null,
            posts: [],
        }
    },
    methods: {
        getID: function() {
            FB.api(
                this.competitor.pages[0].url,
                { fields: 'id', access_token: this.fb_token },
                response => {
                    var data = new FormData()
                    data.append('id', this.competitor.pages[0].id)
                    data.append('page_id', response.id)
                    this.$http.post('/api/facebook/save-page-id', data).then(response => {
                        this.competitor = response.data
                    })
                }
            )
        },
        getThePage: function() {
            this.$http.get('/api/competitor/'+this.competitor_id).then(response => {
                this.competitor = response.data

                if (this.competitor.pages[0].FBid) {
                    this.pageID = this.competitor.pages[0].FBid
                } else {
                    this.getID()
                }
            })
        },
        grabPosts: function() {
            if (this.pageID) {
                FB.api(
                    '/'+this.pageID+'/feed',
                    { access_token: this.fb_token },
                    response => {
                        var data = new FormData()
                        data.append('page_id', this.competitor.pages[0].id)
                        data.append('posts', JSON.stringify(response.data))

                        this.$http.post('/api/facebook/save-posts', data).then(response => {
                            this.posts = response.data
                            console.log(this.posts)
                        })
                    }
                )
            } else {
                this.getID()
            }
        }
    },
    mounted: function() {
        this.getThePage()
    }
}
</script>

<style lang="scss">
</style>
