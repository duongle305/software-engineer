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
    Auth::routes();
    Route::get('/dashboard','SalesManagement\DashboardController@index')->name('admin.dashboard');
    Route::post('/setting-template','SalesManagement\DashboardController@setting')->name('setting.template');
    Route::resource('/users','SalesManagement\UserController');



    Route::get('/ajax/provinces', 'SalesManagement\AjaxController@provinces');
    Route::get('/ajax/districts/{id}', 'SalesManagement\AjaxController@districts');
    Route::get('/ajax/wards/{id}', 'SalesManagement\AjaxController@wards');
});