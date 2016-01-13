<template>
    <div id="step-5" class="row">

        <div class="col-md-3">
            <img id="plane-img" class="img-responsive" src="/images/steps/LeadPropeller-5.png">
            </div>

            <div class="col-md-9">

                <div class="row sub-header">
                    <div class="col-md-1">
                        <div class="numberCircle">
                            <div class="height_fix"></div>
                            <div class="content">5</div>
                        </div>
                    </div>
                    <div class="col-md-11">
                        <h3>Upload a logo</h3>
                        <p>Don't have a logo? <a href="#" data-toggle="modal" data-target="#noLogo">Click here to find out where to get a professional logo on the cheap</a></p>
                        <p>IMPORTANT! Before uploading: <a href="#"  data-toggle="modal" data-target="#logoSize">Click here to see recommended sizes for your logo</a></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-11 col-md-offset-1">
                        <input type="text" id="siteType" class="hidden" v-model="site_type">
                        <input type="text" id="websiteId" class="hidden" v-model="website_id">
                        <!-- D&D Zone-->
                        <div id="drag-and-drop-zone" class="uploader">
                            <div>Drag &amp; Drop Images Here</div>
                            <div class="or">-or-</div>
                            <div class="browser">
                                <label>
                                    <span>Click to open the file Browser</span>
                                    <input type="file" accept="image/*" name="files[]" id="image" title='Click to add a logo' @click="imageUploaded">
                                    </label>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-11 col-md-offset-1">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Uploads</h3>
                                </div>
                                <div class="panel-body demo-panel-files" id='demo-files'>

                                    <span class="demo-note" v-if="!logoHasBeenUploaded">No Files have been selected/droped yet...</span>
                                </div>
                            </div>
                            <div id="progress" class="progress hidden">
                              <div id="upload-progress" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 col-md-offset-1">
                            <a v-link="{name: 'step4'}" class="btn btn-primary btn-lg btn-block">Back - Step 4</a>
                        </div>
                        <div class="col-md-5 col-md-offset-1">
                            <a v-link="{name: 'step6'}" class="btn btn-primary btn-lg btn-block">Next - Step 6</a>
                        </div>
                    </div>
                </div>
            </div>
</template>

<script>
    require('../../dmuploader.min.js');
    export default {
        name: 'Step5',
        data(){
            return {
                site_type: '',
                website_id: '',
                logoHasBeenUploaded: ''
            }
        },
        methods: {
            imageUploaded: function(){
                this.site_type = this.$parent.Site.website_type;
                this.website_id = this.$parent.Website.id;
                this.logoHasBeenUploaded = true;
                $('#drag-and-drop-zone').dmUploader({
                    url: '/business-info/upload/logo/',
                    method: 'post',
                    extraData: {
                      site_type: this.site_type,
                      website_id: this.website_id
                    },
                    onNewFile: function(id,file){
                        addFile('#demo-files',id,file);
                        if (typeof FileReader !== "undefined"){

                             var reader = new FileReader();

                             // Last image added
                             var img = $('#demo-files').find('.demo-image-preview').eq(0);

                             reader.onload = function (e) {
                               img.attr('src', e.target.result);
                             }

                             reader.readAsDataURL(file);

                           } else {
                             // Hide/Remove all Images if FileReader isn't supported
                             $('#demo-files').find('.demo-image-preview').remove();
                           }
                            $('#progress').removeClass('hidden');
                    },
                    onUploadProgress: function(id, percent){
                        $('#upload-progress').css('width',percent+'%');
                        if (percent == 100) {
                            $('#upload-progress').css('width','0%');
                        }
                    },
                    onUploadSuccess: function(id,data){
                        $('#progress').addClass('hidden');
                        console.log(data);
                    },
                    onUploadError:function(id,data){
                        console.log(data);
                        // console.log(id);
                    }
                });
            }
        }
    }
</script>
