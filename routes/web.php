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
    return redirect('/ideas');
});
Route::get('search', 'IdeasController@search');
Auth::routes();

Route::get('/ideas/myidea', 'IdeasController@myidea');
Route::get('/ideas/{idea}/storecomment', 'IdeasController@storeComment');
Route::get('/ideas/{idea}/updatecomment', 'IdeasController@updateComment');
Route::get('/try/{id}/updatecomment', 'IdeasController@try');
Route::resource('ideas', 'IdeasController');

Route::get('/home', 'HomeController@index')->name('home');


