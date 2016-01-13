<template>
	<div class="col-md-6 col-md-offset-3">
		<h1>LOGIN</h1>
		<div class="row">
			<div class="col-md-12">
				<form class="form">
					<div class="form-group">
						<input required v-model="email" placeholder="email" type="email" class="form-control" maxlength="100" required>
					</div>
					<div class="form-group">
						<input required v-model="password" placeholder="password" type="password" class="form-control" maxlength="100">
					</div>
					<button v-if="!store.submitText" @click="submit" class="btn btn-primary col-md-12">login</button>
					<button v-if="store.submitText" class="btn col-md-12"><i class="fa fa-spinner fa-pulse"></i></button>
					
				</form>
			</div>
		</div>
	</div>
</template>
<script>
	var store = require('../modules/store')
	export default {

		name: 'Login',

		data(){
	        return {
	            store,
	            email: null,
	            password: null,
	        }
	    },

		methods: {

			submit: function(){

				store.submitText = true

				var resource = this.$resource('/api/auth')

				resource.save({
					email: this.email,
					password: this.password

				},function(request){
                    store.submitText = false

                    if(request.error){
                    	console.log('error')

                    }
                    if(request.seccuss){
                    	this.$route.router.go({name: 'dashboard'})
                    }
                })
			},

		}
	}
</script>