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

Route::get('/', 'HomeController@index')->name('home');

Route::get('pensioners', 'PensionersController@index')->name('pensioners');

Route::get('employees', 'EmployeesController@index')->name('employees');

Route::get('events', 'EventsController@index')->name('events');

Route::get('events/specials', 'EventsController@specialsIndex')->name('specials');

Route::get('profile', 'ProfileController@index')->name('profile');

Route::get('admins', 'AdminsController@index')->name('admins');

Route::get('config', 'ConfigController@index')->name('config');


