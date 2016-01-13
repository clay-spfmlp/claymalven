@extends('layouts.main')


@section('link')
    <link rel="stylesheet" type="text/css" href="/css/web.css">
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
@endsection

@section('content')
	<div class="container">
		<div id="web" v-cloak>
	        <router-view transition="fadeView"></router-view>
	    </div>
    </div>
@endsection

@section('script')
    <script src="/js/web.js"></script>
@endsection