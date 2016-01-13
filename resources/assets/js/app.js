var Vue = require('vue')
var VueRouter = require('vue-router')
var VueResource = require('vue-resource')

window.$ = window.jQuery = require('jquery')
var bootstrap = require('bootstrap/dist/js/bootstrap')

Vue.use(VueRouter)
Vue.use(VueResource)

import NavBar from './components/NavBar.vue'

var store = require('./modules/store')

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


Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#_token').getAttribute('value');

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
    '/login': {
        component: require('./components/Login.vue'),
        name: 'login'
    },
    '/dashboard': {
    	component: require('./components/FunStuff.vue'),
    	name: 'dashboard'
    },
})

router.start(App, '#app')

var bus = new Vue()


Vue.transition('fadeView', {
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