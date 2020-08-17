<?php

use Illuminate\Routing\RouteGroup;
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

Route::name('admin.')->prefix('admin')->group(function () {
    /***** AUTH ROUTES *****/
    Route::get('/login', 'AdminAuthController@getLogin')->name('get_login');
    Route::post('/login', 'AdminAuthController@login')->name('post_login');
    Route::get('/logout', 'AdminAuthController@logout')->name('logout');
    Route::get('/forgot/password', 'AdminAuthController@get_forgot_password')->name('get_forgot_password');
    Route::post('/forgot/password', 'AdminAuthController@forgot_password')->name('forgot_password');
    Route::get('/reset/password/{token}', 'AdminAuthController@get_reset_password')->name('get_reset_password');
    Route::post('/reset/password/{token}', 'AdminAuthController@reset_password')->name('reset_password');
    Route::group(['middleware' => ['auth']], function () {
        /***** DASHBOARD ROUTES *****/
        Route::get('/', 'DashboardController@index')->name('welcome');
        /***** PROFILE ROUTES *****/
        Route::get('/profile', 'ProfileController@show')->name('profile.show');
        Route::post('/profile', 'ProfileController@update')->name('profile.update');
        /***** PRODUCTS ROUTES *****/
        Route::get('/products', 'ProductController@index')->name('products');
        Route::get('/products/create', 'ProductController@create')->name('products.create');
        Route::post('/products/store', 'ProductController@store')->name('products.store');
        Route::get('/products/{id}/edit', 'ProductController@edit')->name('products.edit');
        Route::post('/products/{id}/update', 'ProductController@update')->name('products.update');
        Route::post('/products/{id}/delete', 'ProductController@destroy')->name('products.delete');
        /***** ROLES ROUTES *****/
        Route::get('/roles', 'RoleController@index')->name('roles');
        Route::get('/roles/{id}/edit', 'RoleController@edit')->name('roles.edit');
        Route::post('/roles/{id}/update', 'RoleController@update')->name('roles.update');
    });
});
