<template>
    <div id="step-0" class="row">

        <div class="col-md-12">
            <h1 class="text-center">Welcome!</h1>
            <h3 class="text-center">Your Lead Generating Adventure Begins Here.</h3>
            <div class="text-center">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/_l5DuiUgQrg?controls=1&showinfo=0&autoplay=0&rel=0&border=0" frameborder="0" allowfullscreen></iframe>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <h4 class="text-center">What's Next?</h4>
                <i class="pull-left fa fa-recycle"></i>
                <p>Preflight</p>
                <ul>
                    <li>Choose a website type/template/</li>
                    <li>domain name</li>
                    <li>Customize and Personalize</li>
                </ul>
                <i class="pull-left fa fa-paper-plane"></i>
                <p>Takeoff</p>
                <ul>
                    <li>Enable built-in SEO</li>
                    <li>Promote</li>
                </ul>
                <i class="pull-left fa fa-cloud"></i>
                <p>Cruise</p>
                <ul>
                    <li>Content Marketing</li>
                    <li>SEO</li>
                    <li>Pay Per Click</li>
                </ul>
                <a v-link="{name: 'step1'}" class="btn btn-primary btn-lg btn-block">Begin Preflight</a>

            </div>

        </div>
    </div>
</template>

<script>
export default {
    name: 'Welcome',
}
</script>
