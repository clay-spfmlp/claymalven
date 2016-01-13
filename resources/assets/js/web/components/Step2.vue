<template>
    <div v-show="$parent.ready" class="row">

        <div id="plane-1" class="col-md-3">
            <img class="img-responsive" src="/images/steps/LeadPropeller-2.png" alt="">
        </div>
        <div class="col-md-9">
            <sub-header number='2'>Choose a {{ siteType }} website template</sub-header>
            <div class="row">
                <div v-for="template in fetchedTemplates" v-show="template.website_type == siteType" class="col-md-6 " style="margin-bottom:15px;">
                    <div class="ih-item square colored effect6 from_top_and_bottom" v-bind:class="[templateChosen.id == template.id ? 'selected' : template.selectedClass]">
                        <a>
                            <div class="img"><img :src="template.preview_thumbnail" alt="{{template.name}}"></div>
                            <div class="info">
                                <h3>{{template.name}}</h3>
                                <p>
                                    <button type="button" name="button" class="btn btn-primary"
                                        @click.stop.sync="selectTemplate(template)">{{ templateChosen.id == template.id ? 'Selected Template' : 'Use Template'}}</button>
                                    <button class="btn btn-info" @click="viewDemo(template.path)">Demo</button>
                                    <p class="templateText">{{{ template.description }}}</p>
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
                <h4 id="templateChosenText">Your Chosen Template: <b>{{ templateChosen.name }}</b></h4>
                <div class="col-md-5">
                    <a @click="backStep1(templateChosen)" class="btn btn-primary btn-lg btn-block hvr-float-shadow">Back - Step 1</a>
                </div>
                <div class="col-md-5 col-md-offset-2">
                    <button @click="nextStep3(templateChosen)" class="{{ !templateChosen.id ? 'disabled' : 'btn-primary' }} btn btn-lg btn-block hvr-float-shadow">{{ !templateChosen.id ? 'Select a Template': 'Next - Step 3' }}  <i v-if="Page.next" class="fa fa-spinner fa-pulse"></i></button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import SubHeader from '../components/SubHeader.vue'

    export default {
        name: 'Step2',
        data(){
            return {
                siteType: this.$parent.Site.website_type,
                templateChosen: this.$parent.Template,
                fetchedTemplates: this.$parent.fetchedTemplates,
                Page: {
                    next: false
                }
            }
        },
        components: {
            'sub-header' : SubHeader
        },
        created: function(){
            if(this.$parent.isEmpty(this.fetchedTemplates) || this.$parent.isEmpty(this.$parent.Site)){
                console.log('no fetchedTemplates')
                this.$route.router.go({name: 'step1'});
            }
        },
        methods: {
            selectTemplate: function(template){
                this.templateChosen = template
                this.$parent.Template = template
                for(var index in this.fetchedTemplates){
                    this.fetchedTemplates[index].selectedClass = '';
                    if(this.fetchedTemplates[index].name != template.name) {
                        this.fetchedTemplates[index].selectedClass = 'gray'
                    }
                }
            },
            backStep1: function(){
                console.log('back to step 1')
                this.$route.router.go({name: 'step1'})
            },
            nextStep3: function(templateChosen){
                this.Page.next = true
                var parent = this.$parent
                console.log(templateChosen)
                parent.updateSite(parent.Site.id, {all_template_id: templateChosen.template_id, step: 3})
                this.$route.router.go({name: 'step3'})
            },  
            viewDemo: function(path){
                window.open(path,'_blank');
            }
        }
    }
</script>

<style>
.ih-item.square {
    width: 400px;
    height: 280px;
}
#templateChosenText {
    text-align: center;
    margin: 35px 0;
}
.ih-item.square.effect6 .info p.templateText {
    color: #fff;
    background: rgba(85,85,85, 0.82);
    padding: 25px 20px;
}
</style>
