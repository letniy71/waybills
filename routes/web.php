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



Route::group(['middleware' => 'admin'], function () {
    // Здесь перечисляются маршруты, доступ к которым будет открыт только администраторам
//Настройки
	Route::get('/settings', function () {
    return view('main');
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
	//Удаление Адресовs
	Route::post('address/delete', 'App\Http\Controllers\AddressController@deleteAddress')->name('delete-address');


//Справочник Маршрутов
	Route::get('route', 'App\Http\Controllers\RouteController@getRoute')->name('all-route');
	//Добавление Адресов
	Route::post('route', 'App\Http\Controllers\RouteController@addRoute');
	//Удаление Адресов
	Route::post('route/delete', 'App\Http\Controllers\RouteController@deleteRoute')->name('delete-route');

//Регистрация пользоватлей
	//Список пользоватлей
	Route::get('register', 'App\Http\Controllers\Auth\RegisterController@getUsers')->name('register');
	//Добавление пользовтелей
	Route::post('register', 'App\Http\Controllers\Auth\RegisterController@register')->name('register');
	//Удаление пользователей
	Route::post('register/delete', 'App\Http\Controllers\Auth\RegisterController@deleteuser')->name('delete-register');
	//Редактирование пользователей
	Route::get('register/edit', 'App\Http\Controllers\Auth\RegisterController@showEditUser')->name('show-edit-user');
	Route::post('register/edit', 'App\Http\Controllers\Auth\RegisterController@editUser')->name('edit-user');

	

});
Auth::routes(['register' => false]);


//Справочник Путевых Листов


Route::group(['middleware' => 'auth'], function () {

Route::get('waybills', 'App\Http\Controllers\WaybillsController@getWaybills')->name('all-waybills');
Route::get('waybills/{$date}', 'App\Http\Controllers\WaybillsController@getWaybills')->name('date-waybills');

//Добавление Путевых Листов
Route::post('waybills', 'App\Http\Controllers\WaybillsController@addWaybills')->name('add-waybills');;
//Удаление Путевых Листов
Route::post('waybills/delete', 'App\Http\Controllers\WaybillsController@deleteWaybills')->name('delete-waybills');
//Редактирование Путевых Листов
Route::get('waybills/edit', 'App\Http\Controllers\WaybillsController@showEditWaybills')->name('show-edit-waybills');
Route::post('waybills/edit', 'App\Http\Controllers\WaybillsController@editWaybills')->name('edit-waybills');


Route::get('/', function () {
    return redirect()->route('all-waybills');
});
});




