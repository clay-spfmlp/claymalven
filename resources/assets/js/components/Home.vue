<template>
	<div class="content">
	    <div class="title text-center">
	    	<span class="fullName animated flip">
			    <span v-modal="first.C" class="name first c animated fadeInLeftBig">{{ first.C }}</span>
			    <span v-modal="first.l" class="name first l animated fadeInDownBig">{{ first.l }}</span>
			    <span v-modal="first.a" class="name first a animated fadeInUpBig">{{ first.a }}</span>
			    <span v-modal="first.y" class="name first y animated fadeInRightBig">{{ first.y }}</span>
			    <span class="name space"> </span>
			    <span v-modal="last.M" class="name last m animated zoomIn">{{ last.M }}</span>
			    <span v-modal="last.a" class="name last a animated zoomIn">{{ last.a }}</span>
			    <span v-modal="last.l" class="name last l animated zoomIn">{{ last.l }}</span>
			    <span v-modal="last.v" class="name last v animated zoomIn">{{ last.v }}</span>
			    <span v-modal="last.e" class="name last e animated zoomIn">{{ last.e }}</span>
			    <span v-modal="last.n" class="name last n animated zoomIn">{{ last.n }}</span>
		    </span>
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
            	first: {
            		C: 'C',
            		l: 'l',
            		a: 'a',
            		y: 'y',
            	},
            	last: {
            		M: 'M',
            		a: 'a',
            		l: 'l',
            		v: 'v',
            		e: 'e',
            		n: 'n',
            	},
            	resumeText: false,
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

	.name.first {
	  animation-duration: 2s;
	  animation-delay: .5s;
	}

	.name.last {
	  animation-duration: 2s;
	}
	.name.last.m {
		animation-delay: 2s;
	}
	.name.last.a {
		animation-delay: 2.1s;
	}
	.name.last.l {
		animation-delay: 2.2s;
	}
	.name.last.v {
		animation-delay: 2.3s;
	}
	.name.last.e {
		animation-delay: 2.4s;
	}
	.name.last.n {
		animation-delay: 2.5s;
	}
	.fullName {
		animation-duration: .75s;
	    animation-delay: 10s;
	}

</style>