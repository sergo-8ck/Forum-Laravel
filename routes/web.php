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

Route::get('/home', 'HomeController@index');
Route::get('threads', 'ThreadController@index');
Route::get('threads/create', 'ThreadController@create');
Route::get('threads/{channel}/{thread}', 'ThreadController@show');
Route::post('threads', 'ThreadController@store');
Route::get('threads/{channel}', 'ThreadController@index');
Route::post('/threads/{channel}/{thread}/replies', 'ReplyController@store');


//Route::resource('threads', 'ThreadController');

Route::post('/threads/{channel}/{thread}/replies', 'ReplyController@store')
    ->name('post.reply')
    ->middleware('auth'); //сохранить


Auth::routes();

