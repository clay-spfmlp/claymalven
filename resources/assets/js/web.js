var Vue = require('vue');
window.$ = window.jQuery = require('jquery');
var bootstrap = require('bootstrap/dist/js/bootstrap');
var VueRouter = require('vue-router');
var VueResource = require('vue-resource');
var Validator = require('vue-model-validator');


Vue.use(VueRouter);
Vue.use(VueResource);
Vue.use(Validator);

var router = new VueRouter();
var App = Vue.extend({
    data(){
        return {
            User: {},
            Website: {},
            Template: {},
            Site: {},
            fetchedTemplates: {},
            ready: false
        }
    },
    created: function(){
        this.syncData()
        this.getAllTemplates()
    },
    methods: {
        syncData: function(redirect = false){
            var resource = this.$resource('/api/start')
            resource.get({},function(data){
                this.User = data.User;
                this.Website = data.Website;
                this.Template = data.Template;
                this.Site = data.Site;
                this.ready = true;
                this.$children[0].$data.siteType = data.Site.website_type;
                if (this.$route.name == 'step2') {
                    this.$children[0].$data.templateChosen = data.Template;
                }
                if (this.$route.name == 'step3') {
                    this.$children[0].$data.templateChosen = data.Template;
                    this.$children[0].$data.domainOption = data.Site.domain_option;
                    this.$children[0].$data.domain = data.Site.domain;
                    this.$children[0].$data.tld = data.Site.tld;
                    this.$children[0].$data.eppCode = data.Site.epp_code;
                }
                if (this.$route.name == 'step4') {
                    this.$children[0].$data.businessInfo = data.Website;
                }
                if (this.$route.name == 'step6') {
                    this.$children[0].$data.siteType = data.Site.website_type;
                    this.$children[0].$data.Website = data.Website;
                    this.$children[0].$data.User = data.User;
                }
                if(redirect === true){
                    if(this.Site.step) {
                        this.$route.router.go({name: 'step'+this.Site.step});
                    } else {
                        this.$route.router.go({name: 'welcome'});
                    }            
                }
            }.bind(this))
        },
        getAllTemplates: function(){
            var resource = this.$resource('/api/getAllTemplates');
            resource.get({},function(templates){
                if (this.$route.name == 'step2') {
                    this.$children[0].$data.fetchedTemplates = templates;
                };
                this.fetchedTemplates = templates;
            }.bind(this))
        },
        updateSite: function(siteId, data){
            var resource = this.$resource('/api/site/'+siteId);
            resource.update({data},function(site){
                if(data.step){
                    this.$route.router.go({name: 'step'+ site.step });
                }
                this.Site = site;
            }.bind(this));
        },
        isEmpty: function(obj) {
            for(var prop in obj) {
                if(obj.hasOwnProperty(prop))
                    return false;
            }
            return true;
        },
        resetTemplateChosen: function(){
            this.Template = {};
            for(var index in this.fetchedTemplates){
                this.fetchedTemplates[index].selectedClass = '';
            }
        }
    }
});

router.map({
    '/': {
        name: 'home',
        component: require('./web/components/Welcome.vue')
    },
    '/welcome': {
        name: 'welcome',
        component: require('./web/components/Welcome.vue')
    },
    '/step-1': {
        name: 'step1',
        component: require('./web/components/Step1.vue')
    },
    '/step-2': {
        name: 'step2',
        component: require('./web/components/Step2.vue')
    },
    '/step-3': {
        name: 'step3',
        component: require('./web/components/Step3.vue')
    },
    '/step-4': {
        name: 'step4',
        component: require('./web/components/Step4.vue')
    },
    '/step-5': {
        name: 'step5',
        component: require('./web/components/Step5.vue')
    },
    '/step-6': {
        name: 'step6',
        component: require('./web/components/Step6.vue')
    },
    '/step-7': {
        name: 'step7',
        component: require('./web/components/Step7.vue')
    },
    '/congrtulations': {
        name: 'congrtulations',
        component: require('./web/components/Congrtulations.vue')
    },
    '/restart/:siteId': {
        name: 'restart',
        component: require('./web/components/Restart.vue')
    }
});

router.beforeEach(function () {
  window.scrollTo(0, 0);
});

router.start(App, '#web');

Vue.config.debug = true;

Vue.transition('fadeView', {
    css: false,
    enter: function (element, done) {
        $(element)
            .css('opacity', 0)
            .animate({ opacity: 1 }, 800, done);
    },
    enterCancelled: function (element) {
        $(element).stop();
    },
    leave: function (element, done) {
        $(element).animate({ opacity: 0 }, 0, done);
    },
    leaveCancelled: function (element) {
        $(element).stop();
    }
});
