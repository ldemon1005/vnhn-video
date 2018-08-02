<?php

use \Illuminate\Support\Facades\Route;

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
Route::group(['namespace' => 'Video'],function(){
    Route::get('/','IndexController@index')->name('index');
    Route::get('/video/{slug}','IndexController@play_video')->name('play_video');
    Route::get('/group/{slug}','GroupController@get_list')->name('get_list_video');
    Route::get('/search_video','IndexController@search_video')->name('search_video');
});
