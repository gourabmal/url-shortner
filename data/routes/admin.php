<?php

use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Invitation\InvitationController;
use App\Http\Controllers\Admin\ShortUrlController;


Route::group([
    'as' => 'admin.',
    'prefix' => 'v1/cpanel/admin',
    'middleware' => ['web', 'auth', 'role:Admin', 'revalidate']
], function () {

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | INVITATIONS
    |--------------------------------------------------------------------------
    */

    Route::controller(InvitationController::class)
        ->prefix('invitations')
        ->name('invitations.')
        ->group(function () {

            // Invitation list
            Route::get('/', 'index')->name('index');

            // Show invitation form
            Route::get('/create', 'create')->name('create');

            // Save invitation
            Route::post('/', 'store')->name('store');

            // View invitation details
            Route::get('/{invitation}', 'show')->name('show');

            // Resend expired invitation
            Route::post('/{invitation}/resend', 'resend')->name('resend');

            // Delete invitation
            Route::delete('/{invitation}', 'destroy')->name('destroy');
        });

        Route::prefix('short-urls')->name('short-urls.')->group(function () {

            Route::get('/', [ShortUrlController::class, 'index'])
                ->name('index');

            Route::get('/create', [ShortUrlController::class, 'create'])
                ->name('create');

            Route::post('/', [ShortUrlController::class, 'store'])
                ->name('store');
        });
});
