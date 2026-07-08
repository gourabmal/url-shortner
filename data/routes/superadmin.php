<?php

use App\Http\Controllers\SuperAdmin\Dashboard\DashboardController;
use App\Http\Controllers\SuperAdmin\SiteInformation\SiteInformationController;
use App\Http\Controllers\SuperAdmin\Invitation\InvitationController;
use App\Http\Controllers\SuperAdmin\ShortUrlController;


Route::group([
    'as' => 'superadmin.',
    'prefix' => 'v1/cpanel/superadmin',
    'middleware' => ['web', 'auth', 'role:SuperAdmin', 'revalidate']
], function () {

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])
        ->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | Site Information
    |--------------------------------------------------------------------------
    */

    Route::controller(SiteInformationController::class)->group(function () {

        Route::get('/information', 'information')
            ->name('information');

        Route::get('/information-add', 'information_add')
            ->name('information_add');

        Route::post('/information-save', 'information_save')
            ->name('information_save');

        Route::get(
            '/information-edit/{key}',
            'information_edit'
        )
            ->name('information_edit');
    });

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

            // Route::get('/create', [ShortUrlController::class, 'create'])
            //     ->name('create');

            // Route::post('/', [ShortUrlController::class, 'store'])
            //     ->name('store');
        });
});
