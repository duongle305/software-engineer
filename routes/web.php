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
    Route::get('/login','Auth\LoginController@showLoginForm')->name('login');
    Route::post('/login','Auth\LoginController@login');
    Route::middleware('auth')->group(function(){
        Route::get('/logout','Auth\LoginController@logout');
        Route::get('/dashboard','SalesManagement\DashboardController@index')->name('admin.dashboard');
        Route::resource('/users','SalesManagement\UserController')->except('edit','update');
        Route::post('/users/{id}/update-info','SalesManagement\UserController@updateInfo')->name('users.update.info');
        Route::post('/users/{id}/update-photo','SalesManagement\UserController@updatePhoto')->name('users.update.photo');
        Route::post('/users/{id}/change-password','SalesManagement\UserController@changePassword')->name('users.change.password');
        Route::resource('/permissions','SalesManagement\PermissionController');
        Route::resource('/roles','SalesManagement\RoleController');
        Route::resource('/categories','SalesManagement\CategoryController');
        Route::resource('/suppliers','SalesManagement\SupplierController');
        Route::resource('/products','SalesManagement\ProductController');
        Route::resource('/orders','SalesManagement\OrderController');
        Route::resource('/brands','SalesManagement\BrandController');
        Route::resource('/customers','SalesManagement\CustomerController');
        //Ajax
        Route::post('/setting-template','SalesManagement\DashboardController@setting')->name('setting.template');
        Route::get('/ajax/provinces', 'SalesManagement\AjaxController@provinces');
        Route::get('/ajax/districts/{id}', 'SalesManagement\AjaxController@districts');
        Route::get('/ajax/wards/{id}', 'SalesManagement\AjaxController@wards');
        Route::get('/ajax/category/{id}','SalesManagement\AjaxController@category')->name('ajax.category');
//        Route::get('/test',function(){
//            return view('admin.brands.create');
//        });
    });
});