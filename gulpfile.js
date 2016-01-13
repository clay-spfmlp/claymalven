var elixir = require('laravel-elixir');

require('laravel-elixir-vueify');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

// elixir(function (mix) {
//     mix.browserify('app.js').sass('app.scss');
// });

elixir(function (mix) {
    'use strict';
    mix
    // .styles([
    //     'theme.css',
    //     'ihover.css',
    //     'hover.css',
    //     'bootstrap.min.css',
    //     'select2.min.css',
    //     'select2-bootstrap.min.css',
    //     'site-tabs.css',
    //     'wizard-step2.css',
    //     'carousel.css',
    //     'animate.css',
    //     'new-account.css',
    //     'user-signup.css'
    // ],'public/css/web.css')
    .browserify('web.js')
});

