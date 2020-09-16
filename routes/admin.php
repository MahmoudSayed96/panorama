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
    //AUTH ROUTES
    Route::get('/login', 'AdminAuthController@getLogin')->name('get_login');
    Route::post('/login', 'AdminAuthController@login')->name('post_login');
    Route::get('/logout', 'AdminAuthController@logout')->name('logout');
    Route::get('/forgot/password', 'AdminAuthController@get_forgot_password')->name('get_forgot_password');
    Route::post('/forgot/password', 'AdminAuthController@forgot_password')->name('forgot_password');
    Route::get('/reset/password/{token}', 'AdminAuthController@get_reset_password')->name('get_reset_password');
    Route::post('/reset/password/{token}', 'AdminAuthController@reset_password')->name('reset_password');
    Route::group(['middleware' => ['auth']], function () {
        //DASHBOARD ROUTES
        Route::get('/', 'DashboardController@index')->name('welcome');

        //PROFILE ROUTES
        Route::get('/profile', 'ProfileController@show')->name('profile.show');
        Route::post('/profile', 'ProfileController@update')->name('profile.update');

        //PRODUCTS ROUTES
        Route::get('/products', 'ProductController@index')->name('products');
        Route::get('/products/create', 'ProductController@create')->name('products.create');
        Route::post('/products/store', 'ProductController@store')->name('products.store');
        Route::get('/products/{id}/edit', 'ProductController@edit')->name('products.edit');
        Route::post('/products/{id}/update', 'ProductController@update')->name('products.update');
        Route::post('/products/{id}/delete', 'ProductController@destroy')->name('products.delete');

        // MARKETING ROUTES
        Route::name('marketing.')->prefix('marketing')->group(function () {
            //OFFERS ROUTES
            Route::get('/offers', 'OfferController@index')->name('offers');
            Route::get('/offers/create', 'OfferController@create')->name('offers.create');
            Route::post('/offers/store', 'OfferController@store')->name('offers.store');
            Route::get('/offers/{id}/show', 'OfferController@show')->name('offers.show');
            Route::get('/offers/{id}/edit', 'OfferController@edit')->name('offers.edit');
            Route::post('/offers/{id}/update', 'OfferController@update')->name('offers.update');
            Route::post('/offers/{id}/delete', 'OfferController@destroy')->name('offers.delete');


            //SALES ROUTES 
            Route::name('sales.')->prefix('sales')->group(function () {
                //COMPANY SALES ROUTES
                Route::get('/company', 'CompanySalesController@index')->name('company');
                Route::get('/company/create', 'CompanySalesController@create')->name('company.create');
                Route::post('/company/store', 'CompanySalesController@store')->name('company.store');
                Route::get('/company/{id}/edit', 'CompanySalesController@edit')->name('company.edit');
                Route::post('/company/{id}/update', 'CompanySalesController@update')->name('company.update');
                Route::post('/company/{id}/delete', 'CompanySalesController@destroy')->name('company.delete');

                //OUT COMPANY SALES ROUTES
                Route::get('/out-company', 'OutCompanySalesController@index')->name('out_company');
                Route::get('/out-company/create', 'OutCompanySalesController@create')->name('out_company.create');
                Route::post('/out-company/store', 'OutCompanySalesController@store')->name('out_company.store');
                Route::get('/out-company/{id}/edit', 'OutCompanySalesController@edit')->name('out_company.edit');
                Route::post('/out-company/{id}/update', 'OutCompanySalesController@update')->name('out_company.update');
                Route::post('/out-company/{id}/delete', 'OutCompanySalesController@destroy')->name('out_company.delete');
            });
        });


        //INVESTMENTS ROUTES 
        Route::name('investments.')->prefix('investments')->group(function () {
            //RENT ROUTES
            Route::get('/rents', 'RentController@index')->name('rents');
            Route::get('/rents/create', 'RentController@create')->name('rents.create');
            Route::post('/rents/store', 'RentController@store')->name('rents.store');
            Route::get('/rents/{id}/edit', 'RentController@edit')->name('rents.edit');
            Route::post('/rents/{id}/update', 'RentController@update')->name('rents.update');
            Route::post('/rents/{id}/delete', 'RentController@destroy')->name('rents.delete');

            //PREMIUMS ROUTES
            Route::get('/premiums', 'PremiumController@index')->name('premiums');
            Route::get('/premiums/create', 'PremiumController@create')->name('premiums.create');
            Route::post('/premiums/store', 'PremiumController@store')->name('premiums.store');
            Route::get('/premiums/{id}/edit', 'PremiumController@edit')->name('premiums.edit');
            Route::post('/premiums/{id}/update', 'PremiumController@update')->name('premiums.update');
            Route::post('/premiums/{id}/delete', 'PremiumController@destroy')->name('premiums.delete');

            // MANAGEMENTS COMPANY ROUTES
            Route::get('/manage-company-amalak', 'ManageCompanyAmalakController@index')->name('manag_company_amalak');
            Route::get('/manage-company-amalak/create', 'ManageCompanyAmalakController@create')->name('manag_company_amalak.create');
            Route::post('/manage-company-amalak/store', 'ManageCompanyAmalakController@store')->name('manag_company_amalak.store');
            Route::get('/manage-company-amalak/{id}/edit', 'ManageCompanyAmalakController@edit')->name('manag_company_amalak.edit');
            Route::post('/manage-company-amalak/{id}/update', 'ManageCompanyAmalakController@update')->name('manag_company_amalak.update');
            Route::post('/manage-company-amalak/{id}/delete', 'ManageCompanyAmalakController@destroy')->name('manag_company_amalak.delete');

            // MANAGEMENTS COMPANY ROUTES
            Route::get('/manage-clients-amalak', 'ManageClientsAmalakController@index')->name('manag_clients_amalak');
            Route::get('/manage-clients-amalak/create', 'ManageClientsAmalakController@create')->name('manag_clients_amalak.create');
            Route::post('/manage-clients-amalak/store', 'ManageClientsAmalakController@store')->name('manag_clients_amalak.store');
            Route::get('/manage-clients-amalak/{id}/edit', 'ManageClientsAmalakController@edit')->name('manag_clients_amalak.edit');
            Route::post('/manage-clients-amalak/{id}/update', 'ManageClientsAmalakController@update')->name('manag_clients_amalak.update');
            Route::post('/manage-clients-amalak/{id}/delete', 'ManageClientsAmalakController@destroy')->name('manag_clients_amalak.delete');

            // Out Investments ROUTES
            Route::get('/out-investments', 'OutInvestmentController@index')->name('out_investments');
            Route::get('/out-investments/create', 'OutInvestmentController@create')->name('out_investments.create');
            Route::post('/out-investments/store', 'OutInvestmentController@store')->name('out_investments.store');
            Route::get('/out-investments/{id}/edit', 'OutInvestmentController@edit')->name('out_investments.edit');
            Route::post('/out-investments/{id}/update', 'OutInvestmentController@update')->name('out_investments.update');
            Route::post('/out-investments/{id}/delete', 'OutInvestmentController@destroy')->name('out_investments.delete');
        });

        // DECORATION ROUTES
        Route::name('decorations.')->prefix('decorations')->group(function () {
            //COMPANY SALES ROUTES
            Route::get('/company', 'CompanyDecorationController@index')->name('company');
            Route::get('/company/create', 'CompanyDecorationController@create')->name('company.create');
            Route::post('/company/store', 'CompanyDecorationController@store')->name('company.store');
            Route::get('/company/{id}/show', 'CompanyDecorationController@show')->name('company.show');
            Route::get('/company/{id}/edit', 'CompanyDecorationController@edit')->name('company.edit');
            Route::post('/company/{id}/update', 'CompanyDecorationController@update')->name('company.update');
            Route::post('/company/{id}/delete', 'CompanyDecorationController@destroy')->name('company.delete');

            //OUT COMPANY SALES ROUTES
            Route::get('/clients', 'ClientDecorationController@index')->name('clients');
            Route::get('/clients/create', 'ClientDecorationController@create')->name('clients.create');
            Route::post('/clients/store', 'ClientDecorationController@store')->name('clients.store');
            Route::get('/clients/{id}/show', 'ClientDecorationController@show')->name('clients.show');
            Route::get('/clients/{id}/edit', 'ClientDecorationController@edit')->name('clients.edit');
            Route::post('/clients/{id}/update', 'ClientDecorationController@update')->name('clients.update');
            Route::post('/clients/{id}/delete', 'ClientDecorationController@destroy')->name('clients.delete');
        });

        // ADVERTISING ROUTES
        Route::name('advertising.')->prefix('advertising')->group(function () {
            //COMPANY ROUTES
            Route::get('/company', 'CompanyDesignController@index')->name('company');
            Route::get('/company/create', 'CompanyDesignController@create')->name('company.create');
            Route::post('/company/store', 'CompanyDesignController@store')->name('company.store');
            Route::get('/company/{id}/show', 'CompanyDesignController@show')->name('company.show');
            Route::get('/company/{id}/edit', 'CompanyDesignController@edit')->name('company.edit');
            Route::post('/company/{id}/update', 'CompanyDesignController@update')->name('company.update');
            Route::post('/company/{id}/delete', 'CompanyDesignController@destroy')->name('company.delete');

            //CLIENTS ROUTES
            Route::get('/clients', 'ClientDesignController@index')->name('clients');
            Route::get('/clients/create', 'ClientDesignController@create')->name('clients.create');
            Route::post('/clients/store', 'ClientDesignController@store')->name('clients.store');
            Route::get('/clients/{id}/show', 'ClientDesignController@show')->name('clients.show');
            Route::get('/clients/{id}/edit', 'ClientDesignController@edit')->name('clients.edit');
            Route::post('/clients/{id}/update', 'ClientDesignController@update')->name('clients.update');
            Route::post('/clients/{id}/delete', 'ClientDesignController@destroy')->name('clients.delete');
        });

        //  CONSULTING ROUTES
        Route::name('consulting.')->prefix('consulting')->group(function () {
            //COMPANY  ROUTES
            Route::get('/company', 'CompanyConsultingController@index')->name('company');
            Route::get('/company/create', 'CompanyConsultingController@create')->name('company.create');
            Route::post('/company/store', 'CompanyConsultingController@store')->name('company.store');
            Route::get('/company/{id}/show', 'CompanyConsultingController@show')->name('company.show');
            Route::get('/company/{id}/edit', 'CompanyConsultingController@edit')->name('company.edit');
            Route::post('/company/{id}/update', 'CompanyConsultingController@update')->name('company.update');
            Route::post('/company/{id}/delete', 'CompanyConsultingController@destroy')->name('company.delete');

            //OUT COMPANY  ROUTES
            Route::get('/clients', 'ClientConsultingController@index')->name('clients');
            Route::get('/clients/create', 'ClientConsultingController@create')->name('clients.create');
            Route::post('/clients/store', 'ClientConsultingController@store')->name('clients.store');
            Route::get('/clients/{id}/show', 'ClientConsultingController@show')->name('clients.show');
            Route::get('/clients/{id}/edit', 'ClientConsultingController@edit')->name('clients.edit');
            Route::post('/clients/{id}/update', 'ClientConsultingController@update')->name('clients.update');
            Route::post('/clients/{id}/delete', 'ClientConsultingController@destroy')->name('clients.delete');
        });

        // CONSTRUCTIONS ROUTES
        Route::name('constructions.')->prefix('constructions')->group(function () {
            //COMPANY ROUTES
            Route::get('/company', 'CompanyConstructionController@index')->name('company');
            Route::get('/company/create', 'CompanyConstructionController@create')->name('company.create');
            Route::post('/company/store', 'CompanyConstructionController@store')->name('company.store');
            Route::get('/company/{id}/show', 'CompanyConstructionController@show')->name('company.show');
            Route::get('/company/{id}/edit', 'CompanyConstructionController@edit')->name('company.edit');
            Route::post('/company/{id}/update', 'CompanyConstructionController@update')->name('company.update');
            Route::post('/company/{id}/delete', 'CompanyConstructionController@destroy')->name('company.delete');

            //CLIENTS ROUTES
            Route::get('/clients', 'ClientConstructionController@index')->name('clients');
            Route::get('/clients/create', 'ClientConstructionController@create')->name('clients.create');
            Route::post('/clients/store', 'ClientConstructionController@store')->name('clients.store');
            Route::get('/clients/{id}/show', 'ClientConstructionController@show')->name('clients.show');
            Route::get('/clients/{id}/edit', 'ClientConstructionController@edit')->name('clients.edit');
            Route::post('/clients/{id}/update', 'ClientConstructionController@update')->name('clients.update');
            Route::post('/clients/{id}/delete', 'ClientConstructionController@destroy')->name('clients.delete');
        });

        //ROLES ROUTES
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
