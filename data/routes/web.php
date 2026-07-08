<?php

use App\Http\Controllers\Common\LoginController;
use App\Http\Controllers\Frontend\PublicController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Common\InvitationAcceptController;
use App\Http\Controllers\Frontend\RedirectController;


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


Route::get('admin-login', [LoginController::class, 'admin_login'])->name('admin_login');
Route::post('admin-login-check', [LoginController::class, 'admin_login_check'])->name('admin_login_check');


Route::get('/', [PublicController::class, 'index'])->name('frontend.index');

Route::prefix('invitation')->group(function () {

    Route::get('/accept/{token}', [InvitationAcceptController::class, 'show'])
        ->name('invitation.accept');

    Route::post('/accept/{token}', [InvitationAcceptController::class, 'accept'])
        ->name('invitation.accept.submit');

    Route::post('/reject/{token}', [InvitationAcceptController::class, 'reject'])
        ->name('invitation.reject');

        // New
    Route::get('/set-password/{user}', [InvitationAcceptController::class, 'setPassword'])
        ->name('invitation.set-password');

    Route::post('/set-password/{user}', [InvitationAcceptController::class, 'storePassword'])
        ->name('invitation.store-password');
});

Route::get('/clear-cache', function () {
    Artisan::call('optimize:clear');
    return 'Application cache cleared!';
});


// Route::prefix('s')->group(function () {
//     Route::get('/{code}', [RedirectController::class, 'redirect'])
//         ->name('short.redirect');
// });

Route::get('/{code}', [RedirectController::class, 'redirect'])
        ->name('short.redirect');
