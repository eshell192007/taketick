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

use Illuminate\Support\Facades\Route;

Route::get('/', 'FrontController@index');

Route::group(['prefix' => 'user'], function() {
    $controller = 'UserController';
    Route::post('login', "$controller@login");
});

Route::group(['prefix' => 'ticket'], function() {
    Route::get('{id}', "FrontController@ticket")->where('id', '\d+');
    Route::get('add', "FrontController@ticketForm");
});

Route::group(['prefix' => 'settings'], function() {
    Route::get('', "FrontController@showSettings");
});

Route::get('{slug}', function() {
    throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
});