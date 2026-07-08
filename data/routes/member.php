<?php

use App\Http\Controllers\Member\Dashboard\DashboardController;
use App\Http\Controllers\Member\ShortUrlController;


Route::group([
    'as' => 'member.',
    'prefix' => 'v1/cpanel/member',
    'middleware' => ['web', 'auth', 'role:Member', 'revalidate']
], function () {

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])
        ->name('dashboard');

    Route::prefix('short-urls')->name('short-urls.')->group(function () {

        Route::get('/', [ShortUrlController::class, 'index'])
            ->name('index');

        Route::get('/create', [ShortUrlController::class, 'create'])
            ->name('create');

        Route::post('/', [ShortUrlController::class, 'store'])
            ->name('store');
    });
});
