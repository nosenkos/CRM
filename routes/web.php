<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

/*
 *
 * USER ROUTES
 *
 * */

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware'=>['auth']],function(){
    Route::resource('projects','ProjectController');

    Route::group(['prefix'=>'teams'], function(){
       Route::get('/','TeamController@index');
       Route::get('/invite','TeamController@invite');
       Route::post('/invite','TeamController@sendInvite');
       Route::get('/{user}/remove','TeamController@removeUser');
       Route::get('/{team}/leave','TeamController@leaveTeam');
    });

    Route::group(['prefix'=>'profile'], function(){
        Route::get('/','ProfileController@edit');
        Route::post('/','ProfileController@update');
    });

});

/*
 *
 * ADMIN ROUTES
 *
 * */

Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>['auth','isAdmin']], function(){
    Route::get('/','HomeController@index');
});


















