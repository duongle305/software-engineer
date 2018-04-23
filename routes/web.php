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

Route::get('/', function () {
    return view('welcome');
});
Route::prefix('/admin-dl')->group(function(){
    Route::get('/login','SalesManagement\LoginController@showFormLogin');
    Route::post('/login','SalesManagement\LoginController@login')->name('admin.login');
    Route::get('/logout','SalesManagement\Logincontroller@logout')->name('admin.logout');
    Route::get('/dashboard','SalesManagement\DashboardController@index')->name('admin.dashboard');
    Route::post('/setting-template','SalesManagement\DashboardController@setting')->name('setting.template');

    Route::resource('/users','SalesManagement\UserController');


    Route::get('/ajax/districts/{province}', 'SalesManagement\AjaxController@districts');
    Route::get('/ajax/provinces', 'SalesManagement\AjaxController@provinces');
});