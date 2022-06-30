<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // se non si vuol vedere l'errore bisogna trovare la classe a cui appartiene

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
    return view('guest.home');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')
    ->namespace('Admin')
    ->name('admin.')
    ->prefix('admin') //localhost:8000/admin
    ->group(function () {
        Route::get('/', 'HomeController@index')->name('home');
        // Route::get('/posts', 'PostController@index')->name('listapost'); //localhost:8000/admin/posts
        Route::resource('/posts', 'PostController');
        Route::resource('/categories', 'CategoryController');
        Route::resource('/tags', 'TagController');
        Route::resource('/comments', 'CommentController');
    });


// LA ROTTA DI FALLBACK SEMPRE ALLA FINE DEL WEB.PHP!
Route::get("{any?}", function () {
    return view('guest.home');
})->where('any', ".*");
