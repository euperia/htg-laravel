<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('auth/login', [
        'as' => 'auth_login',
        'uses' => 'Auth\AuthController@getLogin'
    ]
);

Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', [
    'as' => 'auth_logout',
    'uses' => 'Auth\AuthController@getLogout'
    ]
);

// Registration routes...
Route::get('auth/register', [
    'as' => 'auth_register',
    'uses' =>'Auth\AuthController@getRegister'
    ]
);
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('/dashboard', [
    'as' => 'dashboard_home',
    'middleware' => 'auth',
    'uses' => 'DashboardController@home'
    ]
);

// Password reset link request routes...
Route::get('password/email', [
    'as' => 'password_email',
    'uses' => 'Auth\PasswordController@getEmail'
    ]
);

Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
});


Route::get('auth/login/google', 'Auth\AuthController@loginWithGoogle');
Route::get('auth/google', 'Auth\AuthController@redirectToProvider');
Route::get('auth/google/callback', 'Auth\AuthController@handleProviderCallback');
