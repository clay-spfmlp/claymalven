<template>
	<ul class="nav nav-pills nav-justified animated slideInDown">
		<li class="aboutLink" v-on:mouseover="showAboutText" v-on:mouseout="hideAboutText" role="presentation"><a v-link="{name: 'about'}">About</a></li>
		<li class="resumeLink" v-on:mouseover="showResumeText" v-on:mouseout="hideResumeText" role="presentation"><a v-link="{name: 'resume'}">Resume</a></li>
		<li class="funStuffLink" role="presentation"><a v-link="{name: 'fun-stuff'}">Fun Stuff</a></li>
		<li class="contactLink" role="presentation"><a v-link="{name: 'contact'}">Contact</a></li>
	</ul>
</template>
<script>
	var store = require('../modules/store')
	export default {
		name: 'Nav',
		data(){
	        return {
	            store
	        }
	    },
		methods: {
			showResumeText: function(){
				store.resumeText = true
			},
			hideResumeText: function(){
				store.resumeText = false
			},
			showAboutText: function(){
				store.aboutText = true
			},
			hideAboutText: function(){
				store.aboutText = false
			},
		}
	}
</script>
<style>
.nav{
	animation-duration: 1s;
	animation-delay: 3.5s;
}
.nav a {
	color: #eee;
}

.nav:hover a {
	color: #eee;
}

.nav a:hover, .nav a:focus{
	color: #fff;
	text-shadow: none;
	background: transparent !important;
}

.nav-pills > li > a {
	border-radius: 0px;
}
.resumeLink:hover < .name.s{
	opacity: 1;
}
</style>