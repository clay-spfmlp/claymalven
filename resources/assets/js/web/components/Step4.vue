<template>
    <div id="step-4" class="row">

        <div class="col-md-3">
            <img id="plane-img" class="img-responsive" src="/images/steps/LeadPropeller-4.png">
            </div>

            <div class="col-md-9">

                <div class="row sub-header">
                    <div class="col-md-1">
                        <div class="numberCircle">
                            <div class="height_fix"></div>
                            <div class="content">4</div>
                        </div>
                    </div>
                    <div class="col-md-11">
                        <h3>Enter your business information <small style="float: right;margin-top: 7px;">This information will be display on your website <i class="fa fa-question-circle"></i></small></h3>
                    </div>
                </div>

                <div class="row">
                    <form class="form-horizontal form" id="businessForm" data-fv-framework="bootstrap" data-fv-icon-valid="glyphicon glyphicon-ok" data-fv-icon-invalid="glyphicon glyphicon-remove" data-fv-icon-validating="glyphicon glyphicon-refresh">
                        <input type="hidden" name="website_id" id="website_id" value="">
                        <input type="hidden" name="siteType" id="siteType" value="">
                        <input type="hidden" name="country_code" id="country_code" value="">
                        <div class="col-md-11 col-md-offset-1">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Company Name <span style="color: #ff0000;">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" name="company_name" v-model="businessInfo.company_name" class="form-control" id="company_name" maxlength="50" data-fv-notempty="true" data-fv-notempty-message="The Company Name field is required">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Address <span style="color: #ff0000;">*</span></label>
                                <div class="col-md-6">
                                    <input type="text" name="business_address" v-model="businessInfo.business_address" class="form-control" id="business_address" maxlength="175" data-fv-notempty="true" data-fv-notempty-message="The Address field is required">
                                </div>

                                <div class="col-md-3">
                                    <input type="text" name="business_address_line_2" v-model="businessInfo.business_address_line_2" class="form-control" id="business_address_line_2" placeholder="Line 2" maxlength="255" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">City/State/Zip <span style="color: #ff0000;">*</span></label>
                                <div class="col-md-4">
                                    <input type="text" name="business_city" v-model="businessInfo.business_city" class="form-control" id="business_city" placeholder="City" maxlength="30" data-fv-notempty="true" data-fv-notempty-message="The City field is required">
                                </div>
                                <div class="col-md-3">
                                    <select name="business_state" v-model="businessInfo.business_state" class="form-control" id="business_state" data-placeholder="State" data-fv-notempty="true" data-fv-notempty-message="The State field is required">
                                        <option>TX</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="business_zip" v-model="businessInfo.business_zip" class="form-control" id="business_zip" placeholder="Zip Code" maxlength="10" data-fv-notempty="true" data-fv-notempty-message="The Zip Code field is required">
                                </div>
                            </div>
                        </div>
                        <div class="sub-header">
                            <div class="col-md-1">
                                <div class="">
                                    <div class="height_fix"></div>
                                    <div class="content"></div>
                                </div>
                            </div>
                            <div class="col-md-11">
                                <h3>Contact information <small style="float: right;margin-top: 7px;">This information will be display on your website <i class="fa fa-question-circle"></i></small></h3>
                            </div>
                        </div>
                        <div class="col-md-11 col-md-offset-1">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Autoresponder From <span style="color: #ff0000;">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" name="autoresponder_from" v-model="businessInfo.autoresponder_from" class="form-control" id="autoresponder_from" placeholder="Full Name" maxlength="50" data-fv-notempty="true" data-fv-notempty-message="The Autoresponder From field is required">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Office Phone <span style="color: #ff0000;">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" name="office_phone" v-model="businessInfo.office_phone" class="form-control" id="office_phone" placeholder="Your Business Contact Number" maxlength="20" data-fv-notempty="true" data-fv-notempty-message="The Phone Number field is required" data-fv-phone="true" data-fv-phone-country="country_code" data-fv-phone-message="The value is not valid %s phone number">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Office Fax </label>
                                <div class="col-md-9">
                                    <input type="text" name="office_fax" v-model="businessInfo.office_fax" class="form-control" maxlength="" data-fv-phone="true" data-fv-phone-message="The value is not valid %s fax number" data-fv-phone-country="country_code">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Email <span style="color: #ff0000;">*</span></label>
                                <div class="col-md-9">
                                    <input type="email" name="email_for_leads" v-model="businessInfo.email_for_leads" class="form-control" id="email_for_leads" placeholder="Your Email" maxlength="100" data-fv-notempty="true" data-fv-notempty-message="The Email field is required">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 col-md-offset-7">
                                <button type="submit" @click.prevent="checkFormIsValid" class="btn btn-primary btn-lg btn-block fv-hidden-submit">Next - Step 5 <i v-if="Page.next" class="fa fa-spinner fa-pulse"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
</template>

<script>
    require('../../formValidation.min.js');
    require('../../bootstrap.min.js');

    export default {
        name: 'Step4',
        data(){
            return {
                businessInfo: this.$parent.Website,
                Page: {
                    next: false
                }
            }
        },
        created: function(){
            $(document).ready(function(){
                // form validation is initialized here in case this is the first page to load or page is refreshed
                $('#businessForm').formValidation();
            });
        },
        attached: function(){
            // form validation is initialized here in case the user comes to this step from another step
            $('#businessForm').formValidation();
        },
        methods: {
            postBusinessInformation: function(){
                this.Page.next = true
                this.businessInfo.site_type = this.$parent.Site.website_type;
                var resource = this.$resource('business-info');
                resource.save(this.businessInfo,function(data){
                    if(data) {
                        this.$route.router.go({name: 'step5'});
                    }
                    if(data.error) {
                        this.Page.next = false
                    }
                }.bind(this))
            },
            checkFormIsValid: function(){
                var businessFormValidation = $('#businessForm').data('formValidation');
                businessFormValidation.validate();
                var formIsValid = businessFormValidation.isValid();
                if (formIsValid) {
                    this.postBusinessInformation();
                };
            }
        }
    }
</script>
