<template>
	<div class="row sub-header">
        <div class="col-md-1 col-xs-2">
            <div class="numberCircle">
                <div class="height_fix"></div>
                <div class="content">{{ step }}</div>
            </div>
        </div>
        <div class="col-md-11 col-xs-10">
            <h3><slot>Go back and enter a title</slot></h3>
        </div>
    </div>
</template>

<script>
    export default {
    	name: 'SubHeader',
    	props: {
    		number: ''
    	},
        data: function(){
            return {
                step: this.number            }
        }
    }
</script>