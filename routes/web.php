<?php

use Illuminate\Support\Facades\Route;

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
    // Ignores notices and reports all other kinds... and warnings
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    // error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});

/*Home*/
Route::get('/', 'Blog\HomeController@getHome');

Route::post('/visita', 'VisitaController@store')->name('post_visita');

//Routes Auth
Route::get('/login',                                'ConnectController@getLogin')                   ->name('login');
Route::post('/login',                               'ConnectController@postLogin')                  ->name('login');

Route::get('/login/{driver}',                        'ConnectController@redirectToProvider')         ->name('redirectToProvider');
Route::get('/login/{driver}/callback',               'ConnectController@handleProviderCallback')     ->name('handleProviderCallback');

Route::get('/recover',                              'ConnectController@getRecover')                 ->name('recovery');
Route::post('/recover',                             'ConnectController@postRecover')                ->name('recovery');

Route::get('/reset',                                'ConnectController@getReset')                   ->name('reset');
Route::post('/reset',                               'ConnectController@postReset')                  ->name('reset');

Route::get('/register',                             'ConnectController@getRegister')                ->name('register');
Route::post('/register',                            'ConnectController@postRegister')               ->name('register');

Route::get('/logout',                               'ConnectController@getLogout')                  ->name('logout');

Route::get('/verification',                         'ConnectController@getVerification')                 ->name('verification');
Route::post('/verification',                        'ConnectController@postVerification')                ->name('verification');

/*SERVICES*/
Route::get('/politicas/{slug}',                       ['uses' => 'Blog\HomeController@getAboutUs',   'as'=> 'politicas',]);

/*Articles*/
Route::get('/seccion/{category}',                         'Blog\HomeController@getCategories')                 ->name('articles');
Route::get('/seccion/{category}/{slug}',                    'Blog\HomeController@getModule')                 ->name('article');
Route::post('/descargar-contacto',                  'Blog\HomeController@pdf_contacto')             ->name('pdf.contacto');
