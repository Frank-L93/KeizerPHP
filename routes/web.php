<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Passwords\Confirm;
use App\Http\Livewire\Auth\Passwords\Email;
use App\Http\Livewire\Auth\Passwords\Reset;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\Verify;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ClubController;
use App\Http\Middleware\SettingsMiddleware;
use App\Http\Livewire\Auth\Settings;
use App\Http\Livewire\Presences;
use App\Http\Livewire\PresencesEdit;
use App\Http\Livewire\PresencesCreate;

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

Route::middleware([\App\Http\Middleware\Language::class])->group(function()
{
    Route::get('/', [Controller::class, 'index'])->name('home');

    Route::middleware([SettingsMiddleware::class])->group(function () {
    // All through settings so the settings are get.
        Route::get('/dashboard', [Controller::class, 'dashboard'])->name('dashboard')->middleware('auth');
        Route::get('/about', [Controller::class, 'about'])->name('about');
        Route::get('/settings', Settings::class)->name('settings')->middleware('auth');
        Route::get('/presences', Presences::class)->name('presences')->middleware('auth');
        Route::get('/presences/edit/{presenceID}/{action}', PresencesEdit::class)->name('presencesEdit')->middleware('auth');
        Route::get('/presences/create', PresencesCreate::class)->name('presencesCreate')->middleware('auth');
    });

    Route::middleware('guest')->group(function () {
        Route::get('login', Login::class)->name('login');
        Route::get('register', Register::class)->name('register');
        Route::get('register/club', [Controller::class, 'clubRegister'])->name('clubRegister');
        Route::post('register/club', [ClubController::class, 'registerClub'])->name('registerClub');
    });

    Route::get('password/reset', Email::class)->name('password.request');
    Route::get('password/reset/{token}', Reset::class)->name('password.reset');
    Route::middleware('auth')->group(function () {
        Route::post('logout', LogoutController::class)->name('logout');
    });

    Route::middleware('Admin')->group(function() {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware('auth');
    });
});

Route::get('/lang/{lang}', [\App\Http\Controllers\ChangeLang::class, 'change_lang']);

