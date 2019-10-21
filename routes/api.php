<?php

use Illuminate\Http\Request;

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

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');

Route::group(['middleware' => 'auth:api'], function(){

  // Api Detail Account Dengan Memanfaatkan Token
  Route::post('details', 'API\UserController@details');

  // Api Crud Book
  Route::get('/books', 'API\BookController@index');
  Route::get('/books/{id}', 'API\BookController@show');
  Route::post('/books', 'API\BookController@store');
  Route::delete('/books/{id}', 'API\BookController@destroy');

});
