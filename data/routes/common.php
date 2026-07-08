<?php

use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Common\LockScreenScreenController;
use App\Http\Controllers\Common\ProfileController;
use App\Http\Controllers\SuperAdmin\SiteInformation\SiteInformationController;
use App\Http\Controllers\Admin\Invitation\InvitationController;


Route::group([
    'as' => 'common.',
    'prefix' => 'v1/cpanel/auth',
    'middleware' => ['web', 'auth', 'revalidate']
], function () {

    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */

    Route::controller(ProfileController::class)->group(function () {

        Route::get('/profile/{name}', 'profile')->name('profile');
        Route::post('/profile-update', 'profile_update')->name('profile_update');
        Route::post('/password-update', 'password_update')->name('password_update');

        Route::get('/admin-logout', 'admin_logout')
            ->name('admin_logout');
    });

});
