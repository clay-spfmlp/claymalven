<template>
    <div id="step-3" class="row">

        <div id="plane-3" class="col-md-3">
            <img class="img-responsive" src="/images/steps/LeadPropeller-3.png" alt="" />
        </div>

        <div class="col-md-9">
            <sub-header number='3'>Choose a domain name for your {{ siteType }} website</sub-header>

            <div id="domainOption"  class="row">
                <div class="col-md-7 col-xs-12 col-md-offset-1">
                    <select v-model="domainOption" class="form-control input-lg">
                        <option v-for="option in domainOptions" v-bind:value="option.value">
                            {{ option.text }}
                        </option>
                    </select>
                </div>

                <div class="col-md-4  col-xs-12">
                    <p v-for="option in domainOptions" v-show="option.value == domainOption" transition="fadeView">{{ option.help }}</p>
                </div>
            </div>
           
            <div id="register" class="row" v-show="domainOption == 'register'" transition="fadeView">
                <form class="form-horizontal form">
                    <div class="input-group">
                        <div class="col-md-6 col-md-offset-1">
                            <input v-model="domain" type="text" class="form-control" placeholder="Domain" style="border-radius:4px;" size="100">
                        </div>
                        <div class="col-md-2">
                            <select v-model="tld" class="form-control" name="category">
                                <option v-for="option in tlds" v-bind:value="option.value">{{ option.value }}</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button style="width: 100%" type="button" class="{{ !domain || !tld ? 'disabled': 'btn-info' }} btn hvr-float-shadow" @click="checkDomain">Check Availability</button>
                        </div>
                    </div>
                </form>
                <div class="col-md-11 col-md-offset-1 thinking" v-show="Page.thinking">
                    <i class="fa fa-refresh fa-spin"></i>
                </div>
                <div class="col-md-11 col-md-offset-1 feedback" v-if="domainChecked && domainOption == 'register'">
                    <div v-if="domainAvailable" class="alert alert-success col-md-12" role="alert">
                        Good News! the domain <strong>{{ userNewDomain }}</strong> is available!
                        <button class="btn btn-sm btn-success hvr-float-shadow pull-right" @click="selectDomain">Countiue with this Domain</button>
                    </div>
                    <div v-else class="alert alert-danger col-md-12" role="alert">
                        Sorry that domain <strong>{{ userNewDomain }}</strong> is not available.
                    </div>
                </div>
            </div>

            <div id="transfer" v-show="domainOption == 'transfer'" transition="fadeView">
                <form class="form-horizontal form">
                    <div class="form-group">
                        <div class="col-md-2 col-md-offset-1">
                            <label class="pull-right">Your Domain</label>
                        </div>
                        <div class="col-md-6">
                            <input v-model="domain" type="text" class="form-control" placeholder="Domain" style="border-radius:4px;">
                        </div>
                        <div class="col-md-3">
                            <select v-model="tld" class="form-control" name="category">
                                <option v-for="option in tlds" v-bind:value="option.value">{{ option.value }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group last">
                        <div class="col-md-2 col-md-offset-1">
                            <label class="pull-right">Your EPP Code</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="EPP code is not required to continue" v-model="eppCode">
                        </div>
                    </div>
                </form>
            </div>

            <div id="suggestionsLink" class="row">
                <div class="col-md-11 col-md-offset-1 text-center">
                    <p>Not sure what to use for your domain name? 
                        <a data-toggle="modal" data-target="#domainSuggestions" data-backdrop="static" @click="suggestions = [], targetCity = '', firstName = '' ">click here to get our best suggestions</a>
                    </p>
                </div>
            </div>

            <div id="navigate" class="row">
                <div class="col-md-5 col-md-offset-1">
                    <a v-link="{name: 'step2'}" class="btn btn-primary btn-lg btn-block hvr-float-shadow">Back - Step 2</a>
                </div>
                <div class="col-md-5 col-md-offset-1">
                    <button @click="reviewWebsite" class="btn btn-lg btn-block hvr-float-shadow" v-bind:class="review" data-toggle="modal" data-target="#siteConfirmation" data-backdrop="static">Review</button>
                </div>
            </div>

            <div id="siteConfirmation" class="modal fade" tabindex="-1" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ Page.modalTitle }}</h4>
                    </div>
                    <div class="modal-body">
                        <div v-show="Page.creating == false">
                            <h3 class="text-center">Your Current Site Details</h3>
                            <p>Your Chosen Website Type: {{ siteType }}</p>
                            <p>Your Chosen Website Domain: {{ completeDomain }}</p>
                            <h3 class="text-center">Your Current Template Details</h3>
                            <div class="templatePreviewImg">
                                <img :src="templateChosen.preview_thumbnail" alt="" />
                            </div>
                            <h4 class="text-center">{{ templateChosen.name }}</h4>
                        </div>
                        <div v-show="Page.creating" class="creating">
                            <i class="fa fa-refresh fa-spin"></i>
                        </div>
                    </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default hvr-float-shadow" @click="closeSiteData" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary hvr-float-shadow" @click="createUserSite" >Create My Site</button>
                  </div>
                </div>
              </div>
            </div>

            <div id="domainSuggestions" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Domain Name Suggestions</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="target_city">Target City:</label>
                                    <input type="text" name="target_city" id="target_city" class="form-control" v-model="targetCity">
                                </div>
                                <div class=" col-md-6">
                                    <label for="first_name">Your First Name:</label>
                                    <input type="text" name="first_name" id="first_name" class="form-control" v-model="firstName" >
                                </div>
                            </div>
                            <div class="row fetching" v-show="Page.fetching">
                                <div class="col-md-12">
                                    <i class="fa fa-refresh fa-spin"></i>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="list-group suggestionList">
                                        <div v-show="Page.suggestionError" class="text-center alert alert-warning">One fields is required.</div>
                                        <a class="list-group-item {{ suggestion.available ? 'success' : 'danger' }}" v-for="suggestion in suggestions" >
                                            <div class="row">
                                                <div v-show="!suggestion.check" class="col-md-1"><i class="fa fa-spinner fa-pulse"></i></div>
                                                <div v-show="suggestion.available" class="col-md-1"><i class="fa fa-check-square-o"></i></div>
                                                <div v-show="!suggestion.available && suggestion.check" class="col-md-1"><i class="fa fa-times-circle-o"></i></div>
                                                <div class="col-md-8">{{ suggestion.domain }}{{ suggestion.tld }}</div>
                                                <div class="col-md-3">{{ !suggestion.check ? 'Checking ...' : '' }}</div>
                                                <div v-show="!suggestion.available && suggestion.check" class="col-md-3">Not Available</div>
                                                <div v-show="suggestion.available" class="col-md-3"><button @click="selectSuggestedDomain(suggestion)" data-dismiss="modal" class="btn btn-sm btn-success center-block">Select</button></div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="col-md-12">
                                <button type="button" id="generate-suggestions" @click="generateSuggestions" class="btn btn-info btn-block hvr-float-shadow text-center" >Generate Suggestions</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import SubHeader from '../components/SubHeader.vue'

    export default {

        name: 'Step3',

        data(){
            return {
                siteType: this.$parent.Site.website_type,
                templateChosen: this.$parent.Template,
                domainOption: this.$parent.Site.domain_option,
                domain: this.$parent.Site.domain,
                tld: this.$parent.Site.tld,
                eppCode: this.$parent.Site.epp_code,
                //templatePreview: this.$parent.Template.preview_thumbnail,
                domainChecked: false,
                domainAvailable: '',
                domainSelected: false,
                //userNewDomain: this.$parent.Website.domain,
                
                
                domainOptions: [
                    { value: '', text: '', help: ''},
                    { value: 'register', text: 'Register New Domain', help: 'Most Common - use this option if you dont currently own a domain' },
                    { value: 'transfer', text: 'Transfer Existing Domain', help: '<<Transfer Existing Domain (NEED COPY) HELP!!!!>>' }
                    //{ value: 'set-nameservers', text: 'Set Name Servers for your domain', help: '<<Set Name Servers for your domain (NEED COPY) HELP!!!>>' }
                ],
                tlds: [
                    { value: '' },
                    { value: '.com' },
                    { value: '.net' },
                    { value: 'realestate' }
                ],
                targetCity: '',
                firstName: '',
                suggestions: [],
                Page: {
                    thinking: false,
                    creating: false,
                    fetching: false,
                    suggestionError: false,
                    modalTitle: 'Before You Continue'
                }
            }
        },
        components: {
            'sub-header' : SubHeader
        },
        computed: {
            completeDomain: function(){
                return this.domain + this.tld
            },
            review: function(){
                var cssClass = 'disabled'
                if( this.domainSelected || this.domainOption == 'transfer' && this.domain && this.tld) {
                    cssClass = 'btn-primary'
                }
                return cssClass
            }
        },
        ready: function () {
            // var parent = this.$parent
            // if( ! this.siteType){
            //     this.$route.router.go({name: 'step1'})
            //     return;
            // }
            // if( ! this.templateChosen){
            //     this.$route.router.go({name: 'step2'})
            //     return;
            // }
        },
        methods: {
            checkDomain: function(){
                this.domainChecked = false
                this.domainSelected = false
                this.Page.thinking = true
                var resource = this.$resource('check-domain/:domain')
                resource.get({domain:this.completeDomain},function(available){
                    this.domainChecked = true
                    this.domainAvailable = available
                    if (available) {
                        this.userNewDomain = this.completeDomain
                    }
                    this.Page.thinking = false
                }.bind(this))
            },
            selectDomain: function(){
                var parent = this.$parent
                this.domainSelected = true
                parent.Site.domain_option = this.domainOption
                parent.Website.domain_name = this.userNewDomain
            },
            selectSuggestedDomain: function(domain){
                var parent = this.$parent
                this.domainSelected = true
                parent.Site.domain_option = 'register';
                this.domainOption = 'register'
                this.tld = domain.tld
                this.domain = domain.name
                parent.Website.domain_name = domain.name
            },
            createUserSite: function(){
                var parent = this.$parent;
                this.Page.creating = true;
                this.Page.modalTitle = 'Creating your '+ this.siteType +' Website';
                parent.Site.domain = this.domain
                parent.Site.tld = this.tld
                parent.Site.epp_code = this.eppCode

                var resource = this.$resource('/add-site');
                resource.save(parent.Site, function(data){

                    if (data.success) {
                        parent.Website = data.website;
                        parent.Site.step = 4;
                        this.Page.creating = false;
                        this.Page.modalTitle = 'Before You Continue';
                        //$('#siteConfirmation').modal('hide');
                        $('.modal-backdrop').removeClass('in');
                        $('.modal-backdrop').addClass('out');
                        parent.updateSite(parent.Site.id,{step:4,website_id:data.website.id});
                    }
                }.bind(this));
            },
            generateSuggestions: function(){
                this.Page.fetching = true
                this.Page.suggestionError = false
                this.suggestions = []
                var resource = this.$resource('/domain-suggestions');
                resource.get({name: this.firstName, city: this.targetCity},function(suggestions){
                    if(suggestions.error){
                        this.Page.suggestionError = true
                        this.Page.fetching = false
                        return
                    }
                    this.suggestions = suggestions.domains
                    this.Page.fetching = false
                    for ( var index in this.suggestions) {
                        this.checkSuggestedDomain(this.suggestions[index])
                    }
                }.bind(this))
            },
            checkSuggestedDomain: function(domain){
                var resource = this.$resource('/check-domain/:domain')
                resource.get({domain: domain.domain + domain.tld},function(data){
                    domain.available = data
                    domain.check = true
                }.bind(this))
            },
            reviewWebsite: function(){
                var parent = this.$parent
                console.log('reviewWebsite')
                parent.updateSite(parent.Site.id, {
                    domain_option: this.domainOption,
                    domain: this.domain,
                    tld: this.tld,
                    epp_code: this.eppCode
                })
            },
            closeSiteData: function(){
                this.Page.creating = false
            }
        }
    }
</script>

<style type="text/css">

    #register, #transfer{
        margin-top: 25px;
    }
    #register .feedback {
        padding-top: 25px;
    }
    #register .feedback .alert {
        margin-bottom: 0;
    }
    #register .thinking {
        font-size: 3.15em;
        text-align: center;
        display: block;
        margin-top: 15px;
    }
    #suggestionsLink {
        padding: 20px 0;
    }
    #navigate {

    }
    .form-group.last {
        margin-bottom: 0;
    }
    .fetching {
        font-size: 13em;
        text-align: center;
        padding-top: 30px;
        display: block;
    }
    .suggestionList {
        padding-top: 20px;
    }
    .suggestionList {
        font-size: 1.2em;
    }
    .list-group-item.danger {
        color: #d9534f;
    }
    .list-group-item.success {
        color: #5cb85c;
    }
    #domainSuggestions .modal-body {
        margin: 0 10px;
    }
    .creating {
        font-size: 18em;
        text-align: center;
    }
    .ih-item.square.effect6.colored.gray .info {
        background: rgba(192, 192, 192, 0.9);
        opacity: 0.6;
        visibility: visible;
    }
    .ih-item.square.effect6.colored.gray .info h3,
    .ih-item.square.effect6.colored.gray .info p {
        visibility: hidden;
        opacity: 0;
    }
    .ih-item.square.effect6.colored.gray a:hover .info,
    .ih-item.square.effect6.colored.gray a:hover .info h3,
    .ih-item.square.effect6.colored.gray a:hover .info p {
        visibility: visible;
        opacity: 1;
    }
    .ih-item.square.effect6.colored.gray a:hover .info {
        background: rgba(26, 74, 114, 0.6);
    }
    .templatePreviewImg img {
        display: block;
        margin: 0 auto;
        border: 8px solid #fff;
        box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
    }
    .h1 .small, .h1 small, .h2 .small, .h2 small, .h3 .small, .h3 small, h1 .small, h1 small, h2 .small, h2 small, h3 .small, h3 small {
    font-size: 50%;
}
</style>
