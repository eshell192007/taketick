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
    $controller = 'TicketController';
    Route::get('{id}', "FrontController@ticket")->where('id', '\d+')->name('ticket.detail');
    Route::get('add', "FrontController@ticketForm");
    Route::post('add', "$controller@add");
    Route::post('{id}/reply', "$controller@reply")->where('id', '\d+');
    Route::post('{id}/edit', "$controller@edit")->where('id', '\d+');
});

Route::group(['prefix' => 'settings'], function() {
    $controller = 'SettingsController';
    Route::get('', "FrontController@showSettings");
    Route::post('{type}/{id}/save', "$controller@save")->where('type', '(priority|status|type)')->where('id', '\d+');
    Route::delete('{type}/{id}', "$controller@delete")->where('type', '(priority|status|type)')->where('id', '\d+');
});

Route::get('{slug}', function() {
    throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
});