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

Route::get('/', 'HomeController@index')
    ->name('home');

Route::get('/detail/{slug}', 'DetailController@index')
    ->name('detail');

Route::prefix('checkout')
    ->middleware(['auth', 'verified'])
    ->group(function() {
        Route::post('{id}', 'CheckoutController@process')
            ->name('checkout-process');
        
        Route::get('{id}', 'CheckoutController@index')
            ->name('checkout');
        
        Route::post('create/{detail_id}', 'CheckoutController@create')
            ->name('checkout-create');
        
        Route::get('remove/{detail_id}', 'CheckoutController@remove')
            ->name('checkout-remove');
        
        Route::get('confirm/{id}', 'CheckoutController@success')
            ->name('checkout-success');
    });

Route::prefix('admin')
    ->namespace('Admin')
    ->middleware(['auth', 'admin'])
    ->group(function() {
        Route::get('/', 'DashboardController@index')
            ->name('dashboard');

        Route::resource('travel-package', 'TravelPackageController');

        Route::prefix('gallery')
            ->group(function () {
                Route::get('trash', 'GalleryController@trash')
                    ->name('gallery-trash');

                Route::get('restore/{id}', 'GalleryController@restore')
                    ->name('gallery-restore');
                    
                Route::get('kill/{id}', 'GalleryController@kill')
                    ->name('gallery-kill');
            });
        Route::resource('gallery', 'GalleryController');

        Route::resource('transaction', 'TransactionController');
    });

Auth::routes(['verify' => true]);
