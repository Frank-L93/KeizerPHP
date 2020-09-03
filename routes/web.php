<?php

use Illuminate\Support\Facades\Route;
use App\User;

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

Route::get('/', 'PagesController@index');
Route::get('/home', 'PagesController@index');
Route::get('/installed', 'PagesController@indexInstall')->name('installed');
Route::get('/about', 'PagesController@about');
Route::get('/privacy', 'PagesController@privacy');
Route::get('/password', 'ActivationController@index')->name('activation');
Route::post('/activation', 'ActivationController@send')->name('sendActivation');
Route::get('/activation/{activate}/{email}', 'ActivationController@activate');
Route::post('/activation_manually', 'ActivationController@activate_man')->name('postActivation');
Auth::routes();

# User Group

Route::resource('presences', 'PresencesController')->middleware('auth');
Route::resource('rounds', 'RoundsController')->middleware('auth');
Route::resource('rankings', 'RankingsController')->middleware('auth');
Route::resource('games', 'GamesController')->middleware('auth');
Route::resource('settings', 'SettingsController')->middleware('auth');
Route::post('/changePassword','SettingsController@ChangePassword')->name('changePassword')->middleware('auth');
Route::post('/changeEmail', 'SettingsController@ChangeEmail')->name('changeEmail')->middleware('auth');
Route::get('notifications', 'NotificationsController@read')->name('readNotifications')->middleware('auth');

# End User Group

# Admin Group

// Administrator-pages (gets)
Route::get('/Admin', 'AdminController@admin')->middleware('admin')->name('Admin');
Route::get('/Admin/Rounds', 'AdminController@RoundsIndex')->middleware('admin');
Route::get('/Admin/Rounds/create', 'AdminController@RoundsCreate')->middleware('admin');
Route::get('/Admin/Presences', 'AdminController@presences')->middleware('admin');
Route::get('/Admin/Presences/create', 'AdminController@InitPresences')->middleware('admin');
Route::get('/Admin/RankingList', 'AdminController@RankingList')->middleware('admin');
Route::get('/Admin/RankingList/{Round}/calculate', 'AdminController@InitCalculation')->middleware('admin');
Route::get('/Admin/RankingList/create', 'AdminController@InitRanking')->middleware('admin');
Route::get('/Admin/RatingList', 'AdminController@RatingList')->middleware('admin');
Route::get('/Admin/Reset', 'AdminController@ResetSeason')->middleware('admin');
Route::get('/Admin/Match/{Round}', 'AdminController@FillArrayPlayers')->middleware('admin');
Route::get('/Admin/Games', 'AdminController@games')->middleware('admin');
Route::get('/Admin/{Game}/Games', 'AdminController@game')->middleware('admin');
Route::get('/Admin/users/list', 'AdminController@List')->middleware('admin');
Route::get('/Admin/users/list2', 'AdminController@List2')->middleware('admin');
Route::get('/Admin/Game/Add/{Round}', 'AdminController@AddGame')->middleware('admin');
Route::get('/Admin/Presence/Add', 'AdminController@AddPresence')->middleware('admin');

// Administrator-pages (posts)
Route::post('/Admin/LoadRatings', 'AdminController@loadRatings')->name('import_process')->middleware('admin');
Route::post('/Admin/LoadRounds', 'AdminController@loadRounds')->name('import_process_rounds')->middleware('admin');
Route::post('/Admin/Rounds/create', 'AdminController@RoundStore')->middleware('admin');
Route::post('/Admin/Games/update', 'AdminController@UpdateGame')->middleware('admin');
Route::post('/Admin/Users/update', 'AdminController@UpdateUser')->middleware('admin');
Route::post('/Admin/Config', 'AdminController@Config')->middleware('admin');
Route::post('/Admin/Game/create', 'AdminController@storeGame')->middleware('admin');
Route::post('/Admin/Presence/create', 'AdminController@storePresence')->middleware('admin');

// Administrator-pages (deletes)
Route::delete('/Admin/{Presence}/Presences', 'AdminController@DestroyPresences')->middleware('admin');
Route::delete('/Admin/{User}/User', 'AdminController@DestroyUser')->middleware('admin');
Route::delete('/Admin/{Game}/Games', 'AdminController@DestroyGames')->middleware('admin');
Route::delete('/Admin/{Round}/Rounds', 'AdminController@DestroyRounds')->middleware('admin');

# End Admin Group

# Web-Push #
Route::post('/push','PushController@store');
Route::get('/push','PushController@push')->name('push');

# RSS Feed #
Route::get('/feed/{API_Token}', 'iOSNotificationsController@getFeedItems');

Route::get('/sendNotification', 'AdminController@SendNotification')->middleware('admin');

Route::group(['prefix' => 'install', 'as' => 'LaravelInstaller::', 'middleware' => ['web', 'install']], function () {
    Route::get('/', [
        'as' => 'welcome',
        'uses' => 'WelcomeController@welcome',
    ]);

    Route::get('environment', [
        'as' => 'environment',
        'uses' => 'EnvironmentController@environmentMenu',
    ]);

    Route::get('environment/wizard', [
        'as' => 'environmentWizard',
        'uses' => 'EnvironmentController@environmentWizard',
    ]);

    Route::post('environment/saveWizard', [
        'as' => 'environmentSaveWizard',
        'uses' => 'EnvironmentController@saveWizard',
    ]);

    Route::get('requirements', [
        'as' => 'requirements',
        'uses' => 'RequirementsController@requirements',
    ]);

    Route::get('permissions', [
        'as' => 'permissions',
        'uses' => 'PermissionsController@permissions',
    ]);

    Route::get('install/database', [
        'as' => 'database',
        'uses' => 'DatabaseController@database',
    ]);

    Route::get('final', [
        'as' => 'final',
        'uses' => 'FinalController@finish',
    ]);

    Route::get('admin', [
        'as' => 'admin',
        'uses' => 'ConfigurationController@admin',
    ]);
    
    Route::post('registerAdmin',
    [
        'as' => 'registerAdmin',
        'uses' => 'ConfigurationController@registerAdmin',
    ]);

    Route::get('configs', [
        'as' => 'configs',
        'uses' => 'ConfigurationController@configs',
    ]);

    Route::post('saveConfigs',
    [
        'as' => 'saveConfigs',
        'uses' => 'ConfigurationController@saveConfigs',
    ]);
});