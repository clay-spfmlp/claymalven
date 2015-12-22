var Vue = require('vue')
var VueRouter = require('vue-router')

Vue.use(VueRouter)

import NavBar from './components/NavBar.vue';

var store = require('./modules/store');

var App = Vue.extend({

	data(){
        return {
            store
        }
    },
    components: {
        'navbar' : NavBar
    },
    methods: {
    	searchShow: function(){
			alert('search')
    	}
    }

})

var router = new VueRouter()

router.map({
	'*': {
        component: require('./components/404.vue'),
        name: '404'
    },
    '/': {
        component: require('./components/Home.vue'),
        name: 'home'
    },
    '/about': {
        component: require('./components/About.vue'),
        name: 'about'
    },
    '/resume': {
        component: require('./components/Resume.vue'),
        name: 'resume'
    },
    '/fun-stuff': {
        component: require('./components/FunStuff.vue'),
        name: 'fun-stuff'
    },
    '/contact': {
        component: require('./components/Contact.vue'),
        name: 'contact'
    },
})

router.start(App, '#app')

var bus = new Vue()


Vue.transition('fadeIn', {
    css: false,
    enter: function (element, done) {
        $(element)
            .css('opacity', 0)
            .animate({ opacity: 1 }, 800, done)
    },
    enterCancelled: function (element) {
        $(element).stop()
    },
    leave: function (element, done) {
        $(element).animate({ opacity: 0 }, 0, done)
    },
    leaveCancelled: function (element) {
        $(element).stop()
    }
});