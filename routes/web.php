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
Route::prefix('/admin-dl')->group(function(){
    Route::get('/login','Auth\LoginController@showLoginForm')->name('login');
    Route::post('/login','Auth\LoginController@login');
    Route::middleware('auth')->group(function(){
        Route::get('/logout','Auth\LoginController@logout')->name('admin.logout');
        Route::get('/dashboard','SalesManagement\DashboardController@index')->name('admin.dashboard');
        Route::resource('/users','SalesManagement\UserController')->except('edit','update');
        Route::post('/users/{id}/update-info','SalesManagement\UserController@updateInfo')->name('users.update.info');
        Route::post('/users/{id}/update-photo','SalesManagement\UserController@updatePhoto')->name('users.update.photo');
        Route::post('/users/{id}/change-password','SalesManagement\UserController@changePassword')->name('users.change.password');
        Route::resource('/permissions','SalesManagement\PermissionController')->except(['show']);
        Route::resource('/roles','SalesManagement\RoleController');
        Route::resource('/categories','SalesManagement\CategoryController');
        Route::resource('/suppliers','SalesManagement\SupplierController');
        Route::resource('/products','SalesManagement\ProductController');
        Route::post('/search-products','SalesManagement\ProductController@search')->name('products.search');
        Route::get('/all-products','SalesManagement\ProductController@products')->name('products.all');
        Route::resource('/orders','SalesManagement\OrderController')->except(['store']);
        Route::resource('/brands','SalesManagement\BrandController');
        Route::resource('/customers','SalesManagement\CustomerController');
        Route::get('/data-orders/{status}','SalesManagement\OrderController@dataOrders')->name('orders.data');
        Route::post('/status-orders/{id}','SalesManagement\OrderController@changeStatus')->name('orders.status');
        //Ajax
        Route::post('/setting-template','SalesManagement\DashboardController@setting')->name('setting.template');
        Route::get('/ajax/provinces', 'SalesManagement\AjaxController@provinces');
        Route::get('/ajax/districts/{id}', 'SalesManagement\AjaxController@districts');
        Route::get('/ajax/wards/{id}', 'SalesManagement\AjaxController@wards');
        Route::get('/ajax/sizes/{id}', 'SalesManagement\AjaxController@sizes')->name('ajax.sizes');
        Route::get('/ajax/colors', 'SalesManagement\AjaxController@colors')->name('ajax.colors');
        Route::get('/ajax/category/{id}','SalesManagement\AjaxController@category')->name('ajax.category');

    });
});