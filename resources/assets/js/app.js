
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')

window.Vue = require('vue')

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import axios from 'axios'
Vue.prototype.$http = axios.create()
let token = document.head.querySelector('meta[name="csrf-token"]')
Vue.prototype.$http.defaults.headers.common = {
    'X-CSRF-TOKEN': token.content,
    'X-Requested-With': 'XMLHttpRequest'
}

import Competitor from './components/Competitor.vue'
import EventBus from './EventBus'


const app = new Vue({
    el: '#app',
    components: {
        Competitor,
    },
    data: function() {
        return {
            fb_token: 'EAACEdEose0cBAGCQAXuLdGdto4X6qRQ2yWmXJhKLsUqgPjJxa3ZCFZCwIBYSibQZCi9bhfinNohc0UZC3KfrAZBbdZBAkAHZAZCJLeZBLEYNaZAxg1JaiUJ9GiVCNEuTyUbatLZCgc5LFvp4bnOtXuSshTDZBMlJLfWkK4I64rX18uMKnTtiH3PxTshvN7JXwQ6ZC6HRKhBut6lkqYQZDZD',
            competitors: [],
        }
    },
    methods: {
        FBLogin: function() {
            FB.login(response => {
                if (response.authResponse) {
                    this.hideLoginBtn()
                } else {
                    alert('Not authorized.')
                }
            })
            return false
        },
        getCompetitors: function() {
            this.$http.get('/api/competitors').then(response => {
                this.competitors = response.data
            })
        },
        hideLoginBtn: function() {
            TweenMax.to(this.$refs.FBbtn, .2, {
                display: 'none',
                opacity: 0,
            })
        }
    },
    mounted: function() {
        this.getCompetitors()
    }
})
