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
//

Route::get('/test1','TestController@test1');
Route::get('/info','TestController@info');


Route::get('/test/dec','TestController@dec');
Route::post('/test/dec2','TestController@dec2');

Route::get('/sign','TestController@sign');

Route::get('/test/sign2','TestController@sign2');
Route::get('/test/header1','TestController@header1');

Route::post('/regdo','Login\LoginController@regdo');
Route::post('/logindo','Login\LoginController@logindo');
