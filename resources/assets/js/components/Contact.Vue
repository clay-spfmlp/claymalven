<template>
	<div class="col-md-6 col-md-offset-3" transition="msg">
		<h1>CONTACT</h1>
		<div class="row">
			<div class="col-md-12" v-if="!store.submitContact">
				<form class="form">
					<div class="form-group">
						<input required v-model="fullName" placeholder="full name" type="text" class="form-control" maxlength="100">
					</div>
					<div class="form-group">
						<input required v-model="email" placeholder="email" type="email" class="form-control" maxlength="100">
					</div>
					<div class="form-group">
						<textarea required rows="4" v-model="message" placeholder="message" class="form-control"></textarea>
					</div>
					<button v-if="!store.submitText" @click="submit" class="btn btn-primary col-md-12">Send</button>
					<button v-if="store.submitText" class="btn col-md-12"><i class="fa fa-spinner fa-pulse"></i></button>
					
				</form>
			</div>
			<div class="col-md-12" v-if="store.submitContact">
				<h3>Thank You</h3>
				<p>I will get in touch with you as soon as I can.</p>
				<button class="btn btn-primary" @click="store.submitContact = false">Back</button>
			</div>
		</div>
	</div>
</template>
<script>
	var store = require('../modules/store')
	export default {

		name: 'Contact',

		data(){
	        return {
	            store,
	            fullName: '',
	            email: '',
	            message: '',
	        }
	    },

		methods: {

			submit: function(){

				store.submitText = true

				var resource = this.$resource('/api/contact')

				resource.save({
					full_name: this.fullName,
					email: this.email,
					message: this.message

				},function(contact){
                    store.submitText = false
                    store.submitContact = true
                })
			},

		}
	}
</script>
<style>

</style>