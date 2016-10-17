<?php

Route::group([
        'prefix' => 'contact',
        'namespace' => 'App\Modules\Contact\Controllers'
    ],
    function () {
        Route::get('/', ['as' => 'contact_index', 'uses' => 'IndexController@index']);
        Route::post('/', ['as' => 'contact_submit', 'uses' => 'IndexController@submit']);
        Route::get('/thank-you', ['as' => 'contact_thankyou', 'uses' => 'IndexController@thankyou']);
});
