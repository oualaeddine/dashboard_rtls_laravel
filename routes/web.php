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

Route::get('logout', 'Auth\LoginController@logout');

Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index')->name('home');

//Rooms
Route::get('chambres', 'RoomsController@index')->name('rooms');
Route::post('chambres', 'RoomsController@store')->name('rooms.add');
Route::put('chambres', 'RoomsController@update')->name('rooms.update');
Route::delete('chambres', 'RoomsController@delete')->name('rooms.delete');

//Pensioners
Route::get('pensioners', 'PensionersController@index')->name('pensioners');
Route::post('pensioners', 'PensionersController@store')->name('pensioners.add');
Route::put('pensioners', 'PensionersController@update')->name('pensioners.update');
Route::delete('pensioners', 'PensionersController@delete')->name('pensioners.delete');

//Employees
Route::get('employees', 'EmployeesController@index')->name('employees');
Route::post('employees', 'EmployeesController@store')->name('employees.add');
Route::put('employees', 'EmployeesController@update')->name('employees.update');
Route::delete('employees', 'EmployeesController@delete')->name('employees.delete');

//Events
Route::get('events/alerts', 'EventsController@alertsIndex')->name('events.alerts');
Route::get('events/seances', 'EventsController@seancesIndex')->name('events.seances');
Route::get('events/specials', 'EventsController@specialsIndex')->name('specials');

// Profile
Route::get('profile', 'ProfileController@index')->name('profile');
Route::put('profile/password', 'ProfileController@updatePassword')->name('profile.password');
Route::put('profile/email', 'ProfileController@updateEmail')->name('profile.email');

//Admins
Route::get('admins', 'AdminsController@index')->name('admins');
Route::post('admins/add', 'AdminsController@store')->name('admins.add');
Route::put('admins/update', 'AdminsController@update')->name('admins.update');
Route::delete('admins/delete', 'AdminsController@delete')->name('admins.delete');

//Settings
Route::get('config', 'ConfigController@index')->name('config');
Route::post('config', 'ConfigController@update')->name('config.update');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
