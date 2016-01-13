<template>
    <div v-show="$parent.ready" id="step-1" class="row">
        <div id="plane-1" class="col-md-3">
            <img class="img-responsive" src="/images/steps/LeadPropeller-1.png" alt="">
        </div>
        <div class="col-md-9">
            <sub-header number='1'>Choose Your website type</sub-header>
            <div class="row">
                <div class="col-md-11 col-xs-12 col-md-offset-1">
                    <select v-model="siteType" class="form-control input-lg">
                        <option v-for="option in siteTypes" v-bind:value="option.value">{{ option.text }}</option>
                    </select>
                </div>
                <div v-if="siteType" transition="fadeView" class="col-md-11 col-xs-12 col-md-offset-1">
                    <p v-for="option in siteTypes" v-if="option.value === siteType" class="template-description" >{{{ option.description }}}</p>
                </div>
                <div id="" v-bind:id="[!siteType ? 'navigate' : '']" class="col-md-5 col-md-offset-7">
                    <button @click="nextStep(siteType)" class="{{ !siteType ? 'disabled': 'btn-primary' }} btn btn-lg btn-block hvr-float-shadow">{{ !siteType ? 'Select a website type': 'Next - Step 2' }}  <i v-if="Page.next" class="fa fa-spinner fa-pulse"></i></button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import SubHeader from '../components/SubHeader.vue';
    export default {
        name: 'Step1',
        data: function(){
            return {
                siteType: null,
                siteTypes: [
                    {value: '', text: '', description: ''},
                    {value: 'Selling', text: 'Motivated Lead Seller Generation', description: 'Most Popular - Used for generated leads from<br> people that want to sell their house fast.'},
                    {value: 'Buying', text: 'House Listing Website (Sell/Rent)', description: 'Most Popular - Used for generated leads from<br> people that want to sell their house fast.'},
                    {value: 'Wholesale', text: 'Wholesaleing Houses Website', description: 'Most Popular - Used for generated leads from<br> people that want to sell their house fast.'},
                    {value: 'Land', text: 'Land Motivated Seller Lead Generation', description: 'Most Popular - Used for generated leads from<br> people that want to sell their house fast.'}
                ],
                Page: {
                    next: false
                }
            }
        },
        components: {
            'sub-header' : SubHeader
        },
        methods: {
            nextStep: function(siteType){
                this.Page.next = true;
                var parent = this.$parent;
                if ( !parent.Site.id ) {
                    this.createSite();
                    return;
                }
                // @TODO  change to its own function that is called onchange
                // if ( this.$parent.Website.id ) {
                //     if(this.siteType != this.$parent.Site.website_type){
                //         console.log('type change: website id exist: confirm change')
                //     }
                // }
                parent.resetTemplateChosen();
                parent.updateSite(parent.Site.id, {website_type: this.siteType, step: 2});
                return
            },
            createSite: function(){
                var parent = this.$parent;
                var resource = this.$resource('/api/site');
                resource.save({user_id: parent.User.id, website_type: this.siteType, step: 2},function(site){
                    parent.Site = site;
                    this.$route.router.go({name: 'step2'});
                }.bind(this))
            }
        }
    }
</script>
<style type="text/css">
    .template-description{
        padding: 20px 0 0;
    }
    #navigate {
        margin-top: 30px
    }
</style>
