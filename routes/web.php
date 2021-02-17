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


//Справочник диспетчеров
	Route::get('dispatchers', 'App\Http\Controllers\DispatchersController@getDispatchers')->name('all-dispatchers');
	//Добавление диспетчеров
	Route::post('dispatchers', 'App\Http\Controllers\DispatchersController@addDispatchers');
	//Удаление диспетчеров
	Route::post('dispatchers/delete', 'App\Http\Controllers\DispatchersController@deleteDispatchers')->name('delete-dispatchers');


//Справочник механиков
	Route::get('mechanics', 'App\Http\Controllers\MechanicsController@getMechanics')->name('all-mechanics');
	//Добавление механиков
	Route::post('mechanics', 'App\Http\Controllers\MechanicsController@addMechanics');
	//Удаление механиков
	Route::post('mechanics/delete', 'App\Http\Controllers\MechanicsController@deleteMechanics')->name('delete-mechanics');


//Справочник Водителей
	Route::get('drivers', 'App\Http\Controllers\DriversController@getDrivers')->name('all-drivers');
	//Добавление Водителей
	Route::post('drivers', 'App\Http\Controllers\DriversController@addDrivers');
	//Удаление Водителей
	Route::post('drivers/delete', 'App\Http\Controllers\DriversController@deleteDrivers')->name('delete-drivers');


//Справочник Адресов
	Route::get('address', 'App\Http\Controllers\AddressController@getAddress')->name('all-address');
	//Добавление Адресов
	Route::post('address', 'App\Http\Controllers\AddressController@addAddress');
	//Удаление Адресов
	Route::post('address/delete', 'App\Http\Controllers\AddressController@deleteAddress')->name('delete-address');


//Справочник Маршрутов
	Route::get('route', 'App\Http\Controllers\RouteController@getRoute')->name('all-route');
	//Добавление Адресов
	Route::post('route', 'App\Http\Controllers\RouteController@addRoute');
	//Удаление Адресов
	Route::post('route/delete', 'App\Http\Controllers\RouteController@deleteRoute')->name('delete-route');


//Справочник Путевых Листов
	Route::get('waybills', 'App\Http\Controllers\WaybillsController@getWaybills')->name('all-waybills');
	//Добавление Путевых Листов
	Route::post('waybills', 'App\Http\Controllers\WaybillsController@addWaybills');
	//Удаление Путевых Листов
	Route::post('waybills/delete', 'App\Http\Controllers\WaybillsController@deleteWaybills')->name('delete-waybills');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
