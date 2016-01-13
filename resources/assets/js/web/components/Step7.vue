<template>
    <div id="step-7"  class="row">
        <div class="col-md-3">
            <img class="img-responsive"src="/images/steps/LeadPropeller-7.png" alt="" />
        </div>
        <div class="col-md-9">
            <div class="row sub-header">
                <div class="col-md-1">
                    <div id="step7" class="numberCircle">
                        <div class="height_fix"></div>
                        <div class="content">7</div>
                    </div>
                </div>
                <div class="col-md-11">
                    <h3>Preview and Publish your website</h3>
                    <p>Now you can preview what your site will look like once it's live on the internet.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-11 col-md-offset-1">
                    <a tabindex="0"type="button" class="btn btn-info btn-lg" data-toggle="tooltip" data-placement="right" title="You many need to refresh the page to view your changes" href="http://leadpropeller.dev{{ this.$parent.Website.path }}" target="_blank">Preview Your Website</a>
                    <p>If everything looks good, you're ready to publish. Be assured you can go back and edit/update your website anytime in the future.</p>
                    <div class="">
                        <div class="">
                            <a type="button" class="btn btn-success btn-lg" href="/website/publish-{{ this.$parent.Site.website_type == 'Buying' ? 'website' : this.$parent.Site.website_type }}/{{ this.$parent.Website.id }}" target="_blank">Publish Your Website</a>
                            <i><br>Your website will be live and can customize it at any time</i>
                            </div>
                            <div class="">
                                <button type="button" class="btn btn-warning btn-lg" v-link="{name: 'congrtulations'}">I'm Not Done Yet, Do not Publish</button>
                                <i><br>Don't worry if you're not done customizing, you'll be able to return to customize and publish later.</i>
                            </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 col-md-offset-1">
                        <a v-link="{name: 'step6'}" class="btn btn-primary btn-lg btn-block">Back - Step 6</a>
                    </div>
                    <div class="col-md-5 col-md-offset-1">
                        <a v-link="{name: 'congrtulations'}" class="btn btn-primary btn-lg btn-block">Complete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'Step7'
    }
</script>
