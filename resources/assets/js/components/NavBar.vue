<template>
<nav class="navbar navbar-fixed-top navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <!-- <a class="navbar-brand" href="#">Brand</a> -->
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav row">
        <li class="col-md-2"><a v-link="{name: 'about'}">About<!-- <span class="sr-only">(current)</span> --></a></li>
        <li class="col-md-2"><a v-link="{name: 'resume'}">Resume</a></li>
        <li class="col-md-2"><a v-link="{name: 'fun-stuff'}">Fun Stuff</a></li>
        <li class="col-md-2"><a v-link="{name: 'contact'}">Contact</a></li>
        <li class="col-md-2"><a v-link="{name: 'login'}">Login</a></li>
      </ul>
<!--       <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
      </ul> -->
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
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