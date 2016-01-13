<template>
	<div class="content">
	    <div class="title text-center">
	    	<span class="fullName animated rubberBand">
	    	<span class="fullName2 animated bounce">
	    	<span class="fullName3 animated shake">
			    <span class="name first c animated zoomIn">C</span>
			    <span class="name first l animated zoomIn">l</span>
			    <span class="name first a animated zoomIn">a</span>
			    <span class="name first y animated zoomIn">y</span>
			    <span class="name space"> </span>
			    <span class="name last m animated zoomIn">M</span>
			    <span class="name last a animated zoomIn">a</span>
			    <span class="name last l animated zoomIn">l</span>
			    <span class="name last v animated zoomIn">v</span>
			    <span class="name last e animated zoomIn">e</span>
			    <span class="name last n animated zoomIn">n</span>
		    </span></span></span>
	    </div>
	</div>
</template>

<script>
	var store = require('../modules/store');
	export default {
		name: 'Home',
		data(){
            return {
            	store,
            }
        },
	}
</script>
<style>
	.name {
		margin-left: -10px;
	}

	.name.space {
		margin-left: 10px;
	}

	.name {
	  animation-duration: .7s;
	}
	.name.first.c {
	  animation-delay: 1s;
	}
	.name.first.l {
	  animation-delay: 1.1s;
	}
	.name.first.a {
	  animation-delay: 1.2s;
	}
	.name.first.y {
	  animation-delay: 1.3s;
	}
	.name.last.m {
		animation-delay: 1.6s;
	}
	.name.last.a {
		animation-delay: 1.8s;
	}
	.name.last.l {
		animation-delay: 1.9s;
	}
	.name.last.v {
		animation-delay: 2s;
	}
	.name.last.e {
		animation-delay: 2.1s;
	}
	.name.last.n {
		animation-delay: 2.2s;
	}
	.fullName {
		animation-duration: .9s;
	    animation-delay: 3s;
	}
	.fullName2 {
		animation-duration: .9s;
	    animation-delay: 4s;
	}
	.fullName3 {
		animation-duration: .9s;
	    animation-delay: 5s;
	}

</style>