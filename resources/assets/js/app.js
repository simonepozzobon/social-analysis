
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

import EventBus from './EventBus'
import FacebookAnalysis from './components/FacebookAnalysis.vue'
import {TweenMax} from 'gsap'

const app = new Vue({
    el: '#app',
    components: {
        FacebookAnalysis,
    },
    data: function() {
        return {
            fb_token: null,
        }
    },
    methods: {
        FBLogin: function() {
            FB.login(response => {
                if (response.authResponse) {
                    TweenMax.to(this.$refs.FBbtn, .2, {
                        display: 'none',
                        opacity: 0,
                    })
                    var accessToken = FB.getAuthResponse()

                    if (accessToken) {
                        this.fb_token = accessToken.accessToken
                    }

                    FB.api(
                        '/rareartlabs',
                        function(response) {
                            console.log(response)
                        }
                    )
                } else {
                    alert('Not authorized.')
                }
            })
            return false
        }
    }
})
