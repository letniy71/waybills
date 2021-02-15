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


//Справочник авто

Route::get('auto', 'App\Http\Controllers\AutoController@getAuto')->name('all-auto');
//Добавление Авто
Route::post('auto', 'App\Http\Controllers\AutoController@addAuto');
//Удаление Авто
Route::get('auto/delete/{id}', 'App\Http\Controllers\AutoController@deleteAuto')->name('delete-auto');

