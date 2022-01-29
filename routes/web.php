<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\ConfigsController;
use App\Http\Controllers\PresencesController;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\RankingsController;
use App\Http\Controllers\RoundsController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\SettingsController;


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

/**
 * Guest related Routes
 */
Route::get('/', [Controller::class, 'index'])->name('home');
Route::get('/about', [Controller::class, 'about'])->name('about');
Route::get('/help', [Controller::class, 'about'])->name('help');
Route::get('password/reset', [PasswordResetLinkController::class, 'create'])->name('password.request');
Route::post('password/reset', [PasswordResetLinkController::class, 'store'])->name('password.resetting');
Route::get('password/reset/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
Route::post('password/new', [NewPasswordController::class, 'store'])->name('password.update');
Route::get('/activate/{user}/{activate}', [Controller::class, 'activate'])->name('activate');


/**
 *  These routes should not be possible to visit when Logged in, so go through the middleware.
 */
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'fillLogin'])
        ->name('login.attempt');
    Route::get('register/club', [Controller::class, 'clubRegister'])->name('register');
    Route::post('register/club', [ClubController::class, 'registerClub'])->name('registerClub');
});

/**
 * Users
 */
Route::middleware('auth')->group(function () {

    /**
     * Kijken
     */
    Route::get('/dashboard', [Controller::class, 'dashboard'])->name('dashboard');
    Route::get('/settings', [Controller::class, 'settings'])->name('settings');
    Route::get('/presences', [PresencesController::class, 'index'])->name('presences');
    Route::get('/games', [GamesController::class, 'view'])->name('games');
    Route::get('/rankings', [Controller::class, 'ranking'])->name('rankings');
    Route::get('/round/{round}', [RoundsController::class, 'data'])->name('roundNumber');
    Route::get('/gamescore/{userID}', [GamesController::class, 'getGameScore'])->name('gameScore');

    /**
     * Aanwezigheden aanmaken
     */
    Route::get('/presences/create', [PresencesController::class, 'singleCreate'])->name('presences.singleCreate');
    Route::post('/presences/create', [PresencesController::class, 'store'])->name('presences.store');
    Route::patch('/presences/edit/{presence_id}', [PresencesController::class, 'patch'])->name('presence.edit');

    /**
     * Details bekijken
     */

    /**
     * Settings aanpassen
     */

    Route::post('/settings', [SettingsController::class, 'update'])->name('user.saveSettings');

    /**
     * Uitloggen
     */

    Route::post('logout', [LoginController::class, 'destroy'])->name('logout');
});


/**
 * Competiteleider
 */
Route::group(['middleware' => ['role:competitionleader']], function () {

    /**
     * Index
     */
    Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware('auth');

    /**
     * Gebruikers
     */
    Route::get('/admin/users', [UsersController::class, 'index'])->name('admin.users')->middleware('auth');
    Route::get('/admin/users/create', [UsersController::class, 'create'])->name('admin.users.create')->middleware('auth');
    Route::post('/admin/users/create', [UsersController::class, 'store'])->name('admin.users.store')->middleware('auth');
    Route::delete('/admin/user/delete/{user}', [UsersController::class, 'destroy'])->name('admin.users.delete')->middleware('auth');
    Route::patch('/admin/users/edit/{user}', [UsersController::class, 'patch'])->name('admin.users.edit')->middleware('auth');
    Route::post('/admin/users/edit', [UsersController::class, 'update'])->name('admin.users.update')->middleware('auth');
    Route::post('/admin/users/resetPassword', [UsersController::class, 'resetPassword'])->name('admin.users.resetPassword')->middleware('auth');

    /**
     * Competitie-instellingen
     */
    Route::get('/admin/configs', [ConfigsController::class, 'index'])->name('admin.configs')->middleware('auth');
    Route::post('/admin/configs', [ConfigsController::class, 'store'])->name('admin.saveConfigs')->middleware('auth');

    /**
     * Rondes
     */
    Route::get('/admin/rounds', [RoundsController::class, 'index'])->name('admin.rounds')->middleware('auth');
    Route::get('/admin/rounds/create', [RoundsController::class, 'create'])->name('admin.rounds.create')->middleware('auth');
    Route::post('/admin/rounds/create', [RoundsController::class, 'store'])->name('admin.rounds.store')->middleware('auth');
    Route::delete('admin/rounds/delete/{round}', [RoundsController::class, 'destroy'])->name('admin.rounds.delete')->middleware('auth');
    Route::patch('/admin/rounds/edit/{round}', [RoundsController::class, 'patch'])->name('admin.rounds.patch')->middleware('auth');
    Route::post('/admin/rounds/edit', [RoundsController::class, 'update'])->name('admin.rounds.update')->middleware('auth');

    /**
     * Aanwezigheden
     */
    Route::get('/admin/presences', [PresencesController::class, 'AdminIndex'])->name('admin.presences')->middleware('auth');
    Route::get('/admin/presences/create', [PresencesController::class, 'create'])->name('admin.presences.create')->middleware('auth');
    Route::get('/admin/presences/create/single', [PresencesController::class, 'singleCreateAdmin'])->name('admin.presences.singleCreate')->middleware('auth');
    Route::post('/admin/presences/create/single', [PresencesController::class, 'storeAdmin'])->name('admin.presences.store')->middleware('auth');
    Route::patch('/admin/presences/edit/{presence_id}', [PresencesController::class, 'patchAdmin'])->name('admin.presence.edit')->middleware('auth');


    /**
     * Ranglijst
     */
    Route::get('/admin/rankings', [RankingsController::class, 'admin'])->name('admin.rankings')->middleware('auth');
    Route::post('/admin/rankings/create', [RankingsController::class, 'create'])->name('admin.rankings.create')->middleware('auth');
    Route::post('/admin/rankings/update', [RankingsController::class, 'update'])->name('admin.rankings.update')->middleware('auth');
    Route::get('/admin/rankings/processing', [RankingsController::class, 'process'])->name('admin.rankings.process')->middleware('auth');
    Route::post('/admin/rankings/processing', [RankingsController::class, 'processGames'])->name('admin.rankings.processGames')->middleware('auth');
    Route::patch('/admin/rankings/patch', [RankingsController::class, 'patch'])->name('admin.rankings.patch')->middleware('auth');
    /**
     * Partijen
     */
    Route::get('/admin/games', [GamesController::class, 'index'])->name('admin.games')->middleware('auth');
    Route::get('/admin/games/create', [GamesController::class, 'create'])->name('admin.games.create')->middleware('auth');
    Route::get('/admin/games/generate', [GamesController::class, 'generate'])->name('admin.games.generate')->middleware('auth');
    Route::patch('/admin/games/patch', [GamesController::class, 'patch'])->name('admin.games.patch')->middleware('auth');
    Route::delete('/admin/games/delete/{game}', [GamesController::class, 'delete'])->name('admin.games.delete')->middleware('auth');
    Route::post('/admin/games/create', [GamesController::class, 'store'])->name('admin.games.store')->middleware('auth');
});

/**
 * Super-Admin
 */
