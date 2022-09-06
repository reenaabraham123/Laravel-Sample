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

// Route::get('/', function () {
//     return view('users.index');
// });
Route::get('/','UserController@index');
Route::get('create-user','UserController@create')->name('users.create');
Route::post('save-user','UserController@store')->name('users.save');
Route::get('edit-user/{id}','UserController@edit')->name('users.edit');
Route::post('update-user','UserController@update')->name('users.update');
Route::get('delete-user/{id}','UserController@destroy')->name('users.delete');
Route::get('export','UserController@export')->name('export');
Route::get('pdf','UserController@pdf')->name('pdf');