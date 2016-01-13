@extends('layouts.main')

@section('meta')
    <meta id="_token" value="{{ csrf_token() }}">
@endsection

@section('link')
    <link rel="stylesheet" type="text/css" href="/css/app.css">
@endsection

@section('content')
    <div id="app" class="">
        <navbar></navbar>
        <div class="container-fuild">
            <router-view transition="fadeView"></router-view>
        </div>
    </div>
@endsection

@section('script')
    <script src="/js/app.js"></script>
@endsection