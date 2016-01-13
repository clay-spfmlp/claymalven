<template>
    <div class="container-fluid">
        <h1 id="heading" class="text-center">Congratulations! Your Website is Live!</h1>
        <h2 id="sub-heading"class="text-center">Preflight in now complete. Get ready for takeoff!</h2>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <img class="img-responsive center-block"src="/images/steps/LeadPropeller-7.png" alt="" />

                <h4 class="text-center">We're proud of you and I'm sure your friends will be too.</h4>
                <p class="text-center">Share your beautiful new website so that your friends can see what you've done</p>

                <button type="button" class="btn btn-primary btn-lg btn-block">Share on Facebook</button>
                <button type="button" class="btn btn-warning btn-lg btn-block">Share on Google Plus</button>
                <button type="button" class="btn btn-info btn-lg btn-block">Share on Twitter</button>

                <h4 class="text-center">Please visit your live website and TEST YOUR FORMS</h4>
                <p class="text-center">This is to ensure you are receiving your notifications correctly and email's aren't going to spam</p>

                <button type="button" class="btn btn-success btn-lg btn-block">View your live website</button>
                <a type="button" class="btn btn-primary btn-lg btn-block" href="/dashboard">Go To Your Dashboard</a>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Congratulations',
}
</script>