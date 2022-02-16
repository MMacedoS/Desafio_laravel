<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');


Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::get('addprofile', ['as' => 'profile.add', 'uses' => 'App\Http\Controllers\ProfileController@add']);
	Route::put('createProfile', ['as' => 'profile.create', 'uses' => 'App\Http\Controllers\ProfileController@create']);
	Route::get('profiles', ['as' => 'profile.editAll', 'uses' => 'App\Http\Controllers\ProfileController@editAll']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});


Route::group(['middleware' => 'auth'], function () {	
	Route::get('CreateNoticia', ['as' => 'noticia.add', 'uses' => 'App\Http\Controllers\NoticiaController@add']);
	Route::put('createNoticia', ['as' => 'noticia.create', 'uses' => 'App\Http\Controllers\NoticiaController@create']);
	
});
Route::get('/noticia/{id}', 'App\Http\Controllers\NoticiaController@show')->middleware('auth');


