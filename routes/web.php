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

Route::get('pensioners', 'PensionersController@index')->name('pensioners');

Route::get('employees', 'EmployeesController@index')->name('employees');

Route::get('events', 'EventsController@index')->name('events');

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

Route::get('config', 'ConfigController@index')->name('config');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
