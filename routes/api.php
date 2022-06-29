<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get("/posts", "Api\PostController@index");
Route::get("/posts/{slug}", "Api\PostController@show");
Route::get("/categories", "Api\CategoryController@index"); //prova per le categorie
Route::get("/categories/{slug}", "Api\CategoryController@show"); //prova per le categorie

//ROTTA PER SALVATAGGIO DEI COMMENTI IN POST, NON IN GET PERCHE' NON HO BISOGNO DI UNA VIEW MA DI RICHIAMARE LA FUNZIONE STORE
Route::post("/comments", "Api\CommentController@store");
