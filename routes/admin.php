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
        /***** OFFERS ROUTES *****/
        Route::get('/offers', 'OfferController@index')->name('offers');
        Route::get('/offers/create', 'OfferController@create')->name('offers.create');
        Route::post('/offers/store', 'OfferController@store')->name('offers.store');
        Route::get('/offers/{id}/show', 'OfferController@show')->name('offers.show');
        Route::get('/offers/{id}/edit', 'OfferController@edit')->name('offers.edit');
        Route::post('/offers/{id}/update', 'OfferController@update')->name('offers.update');
        Route::post('/offers/{id}/delete', 'OfferController@destroy')->name('offers.delete');
        /***** SALES ROUTES *****/
        Route::name('sales.')->prefix('sales')->group(function () {
            /***** COMPANY SALES ROUTES *****/
            Route::get('/company', 'CompanySalesController@index')->name('company');
            Route::get('/company/create', 'CompanySalesController@create')->name('company.create');
            Route::post('/company/store', 'CompanySalesController@store')->name('company.store');
            Route::get('/company/{id}/edit', 'CompanySalesController@edit')->name('company.edit');
            Route::post('/company/{id}/update', 'CompanySalesController@update')->name('company.update');
            Route::post('/company/{id}/delete', 'CompanySalesController@destroy')->name('company.delete');
            /***** OUT COMPANY SALES ROUTES *****/
            Route::get('/out-company', 'OutCompanySalesController@index')->name('out_company');
            Route::get('/out-company/create', 'OutCompanySalesController@create')->name('out_company.create');
            Route::post('/out-company/store', 'OutCompanySalesController@store')->name('out_company.store');
            Route::get('/out-company/{id}/edit', 'OutCompanySalesController@edit')->name('out_company.edit');
            Route::post('/out-company/{id}/update', 'OutCompanySalesController@update')->name('out_company.update');
            Route::post('/out-company/{id}/delete', 'OutCompanySalesController@destroy')->name('out_company.delete');
        });
        /***** ROLES ROUTES *****/
        Route::get('/roles', 'RoleController@index')->name('roles');
        Route::get('/roles/{id}/edit', 'RoleController@edit')->name('roles.edit');
        Route::post('/roles/{id}/update', 'RoleController@update')->name('roles.update');
    });
});

Route::get('/test', function () {
    $offer = \App\Models\Offer::find(1);
    return $offer->getPhotos();
    // $product = \App\Models\Product::find(1);
    // return $product->offers;
});
