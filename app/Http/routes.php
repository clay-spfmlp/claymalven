<?php


Route::get('/', function () { return view('index'); });

Route::get('website-creation', 'PageController@index');

Route::group(['prefix' => 'api'], function () {
	Route::resource('contact', 'ContactController');
	Route::post('auth', ['as' => 'auth.post', 'uses' => 'Auth\AuthController@postLogin']);
});

Route::get('check-domain/{domain}','SiteController@getRequestedDomainStatus');
Route::get('domain-suggestions','SiteController@getDomainSuggestions');

Route::group(['before' => ''], function(){
    //Route::get('my-websites', ['as' => 'my.website.index', 'uses' => 'MyWebsitesController@index']);
    Route::get('site-setup', ['as' => 'site.setup', 'uses' => 'SiteController@index']);
    Route::post('add-site','SiteController@addSite');

    Route::group(['prefix' => 'api'], function() {
        Route::resource('site', 'SiteController');
        Route::get('set/session/{key}/{value}', ['as' => 'set.Session', 'uses' => 'SiteController@setSession']);
        Route::get('start', ['as' => 'website.createSite', 'uses' => 'SiteController@startCreateWebsiteApp']);
        Route::get('getAllTemplates', ['as' => 'get.AllTemplates', 'uses' => 'SiteController@getAllTemplates']);
    });
    Route::group(['prefix' => 'business-info'], function(){
        Route::get('/', ['as' => 'business.info', 'uses' => 'SiteController@getBusinessInfo' ]);
        Route::post('/', ['as' => 'business.info.post', 'uses' => 'SiteController@postBusinessInfo' ]);
        Route::post('upload/logo/',['as' => 'business.info.logo.post', 'uses' => 'SiteController@postBusinessInfoLogo' ] );
    });
});