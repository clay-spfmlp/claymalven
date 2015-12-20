var Vue = require('vue')
var VueRouter = require('vue-router')

Vue.use(VueRouter)

var App = Vue.extend({

})

var router = new VueRouter()

router.map({
    '/': {
        component: require('./components/Home.vue')
    },
    '/page': {
        component: require('./components/PageOne.vue')
    }
})

router.start(App, '#app')