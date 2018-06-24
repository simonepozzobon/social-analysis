import Vue from 'vue'

const EventBus = new Vue({
    data: function() {
        return {
            FB: null,
        }
    },
    created: function() {
        this.$on('Fb-login', FB => {
            this.FB = FB
        })
    }
})

export default EventBus
