<template lang="html">
    <div class="container-fluid">
        <div class="row pt-4 pb-3">
            <div class="col w-100">
                <h1 align="center">{{ competitor.name }}</h1>
            </div>
        </div>
        <div class="row pb-4">
            <div class="col-md-4">
                <facebook-analysis :competitor="competitor" :fb_token="fb_token"></facebook-analysis>
            </div>
            <div class="col-md-4">
                <twitter-analysis :competitor="competitor"></twitter-analysis>
            </div>
            <div class="col-md-4">
                <instagram-analysis :competitor="competitor"></instagram-analysis>
            </div>
        </div>
    </div>
</template>

<script>
import FacebookAnalysis from './FacebookAnalysis.vue'
import InstagramAnalysis from './InstagramAnalysis.vue'
import TwitterAnalysis from './TwitterAnalysis.vue'
import {TweenMax} from 'gsap'

export default {
    name: 'Competitor',
    components: {
        FacebookAnalysis,
        InstagramAnalysis,
        TwitterAnalysis,
    },
    props: {
        competitor: {
            type: Object,
            default: function() {},
        },
        fb_token: {
            type: String,
            default: null,
        }
    }
}
</script>

<style lang="css">
</style>
