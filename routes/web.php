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


Route::get('/','CustomerController@index');
Route::post('/customer/store','CustomerController@store');
Route::get('/customer/edit/{id}','CustomerController@edit');
Route::post('/customer/update/{id}','CustomerController@update');
Route::post('/customer/delete/{id}','CustomerController@delete');

