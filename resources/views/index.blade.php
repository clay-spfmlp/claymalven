<!DOCTYPE html>
<html>
    <head>
        <title>Clay Malven</title>
        <meta id="_token" value="{{ csrf_token() }}">

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="/css/app.css">
    </head>
    <body>
        <div id="app" class="">
            <navbar></navbar>
            <div class="container-fuild">
                <router-view transition="fadeView"></router-view>
            </div>
        </div>
        <script src="/js/app.js"></script>
    </body>
</html>