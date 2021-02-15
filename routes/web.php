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
	Route::post('auto/delete', 'App\Http\Controllers\AutoController@deleteAuto')->name('delete-auto');


//Справочник Организаций

	Route::get('org', 'App\Http\Controllers\OrganizationController@getOrg')->name('all-org');
	//Добавление организации
	Route::post('org', 'App\Http\Controllers\OrganizationController@addOrg');
	//Удаление организации
	Route::post('org/delete', 'App\Http\Controllers\OrganizationController@deleteOrg')->name('delete-org');

//Справочник Бригад

	Route::get('brigade', 'App\Http\Controllers\BrigadeController@getBrigade')->name('all-brigade');
	//Добавление бригад
	Route::post('brigade', 'App\Http\Controllers\BrigadeController@addBrigade');
	//Удаление бригад
	Route::post('brigade/delete', 'App\Http\Controllers\BrigadeController@deleteBrigade')->name('delete-brigade');