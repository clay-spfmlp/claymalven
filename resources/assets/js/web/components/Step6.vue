<template>
    <div id="step-6" class="row">
        <div class="col-md-3">
            <img class="img-responsive"src="/images/steps/LeadPropeller-6.png" alt="" />
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-1">
                    <div class="numberCircle">
                        <div class="height_fix"></div>
                        <div class="content">6</div>
                    </div>
                </div>
                <div class="col-md-10">
                    <h3>Customize your website</h3>
                    <p>
                        The default content of the website is fine to use. However, we've found that people that<br> change up
                        the content in their own words tend to do better in search results on Google.<br>You can always do this
                            customization at any time, even after you've already published.<br> So don't feel like you have to do it
                                right this instant.
                            </p>
                            <a href="#">click here to get our top recomendations for customization</a>

                            <h4 id="view-tutorials">Learn to use the website editor for easily customizing you website. <a href="#">view more</a></h4>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="embed-responsive embed-responsive-4by3">
                                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/pZbZe-77kuY" allowfullscreen class="img-responsive"></iframe>
                                    </div>
                                    <p>Editor walk through</p>
                                </div>
                                <div class="col-md-2">
                                    <div class="embed-responsive embed-responsive-4by3">
                                        <iframe class="embed-responsive-item"  src="https://www.youtube.com/embed/KHgEYgr-x0c" allowfullscreen class="img-responsive"></iframe>
                                    </div>
                                    <p>Changing images</p>
                                </div>
                                <div class="col-md-2">
                                    <div class="embed-responsive embed-responsive-4by3">
                                        <iframe class="embed-responsive-item"  src="https://www.youtube.com/embed/CA8IHDeKmwA" allowfullscreen class="img-responsive"></iframe>
                                    </div>
                                    <p>Editing text</p>
                                </div>
                            </div>
                            <a  class="btn btn-primary btn-lg" href="website/edit-{{  this.$parent.Site.website_type == 'Buying'? 'website':  siteLowerCase }}/{{ this.$parent.Website.id }}" target="_blank">Customize Your Site Using Our Editor</a>
                        </div>
                    </div>
                        <div class="row">
                            <div class="col-md-5 col-md-offset-1">
                                <a v-link="{name: 'step5'}" class="btn btn-primary btn-lg btn-block">Back - Step 5</a>
                            </div>
                            <div class="col-md-5 col-md-offset-1">
                                <a v-link="{name: 'step7'}" class="btn btn-primary btn-lg btn-block">Next - Step 7</a>
                            </div>
                        </div>
                    </div>
                </div>

            </template>

<script>
    export default {
        name: 'Step6',
        data(){
            return {
                Website: '',
                User: '',
                siteType: ''
            }
        },
        computed: {
            siteLowerCase: function(){
                return this.siteType.toLowerCase();
            }
        }
    }
</script>
