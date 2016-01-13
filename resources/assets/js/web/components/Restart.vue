<template>
    <div class="row fetching">
        <div class="col-md-12">
            <i class="fa fa-refresh fa-spin"></i>
        </div>
    </div>
</template>
<script>
    export default {

        name: 'Restart',

        data(){
            return {
                siteId: this.$route.params.siteId,
                step: ''
            }
        },
        created: function () {
            this.setSession()
        },
        methods: {
            setSession: function(){
                var resource = this.$resource('api/set/session/siteId/'+this.siteId)
                resource.get({},function(data){
                    this.$parent.syncData(true)
                }.bind(this))
            }
        }
    }
</script>
<style type="text/css">
    .fetching {
        font-size: 13em;
        text-align: center;
        padding-top: 30px;
        display: block;
    }
</style>