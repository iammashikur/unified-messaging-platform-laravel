<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\ChatController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/dashboard', function () {
        return view('dashboard');
    })
    ->name('dashboard');

Route::prefix('/')
    ->middleware(['auth:sanctum', 'verified'])
    ->group(function () {
        // Route::resource('roles', RoleController::class);
        // Route::resource('permissions', PermissionController::class);
        // Route::resource('users', UserController::class);
        //Route::resource('channels', ChannelController::class);
        Route::resource('conversations', ConversationController::class);
        Route::post('chat/send/{id}', [ChatController::class, 'send'])->name('chat.send');


        Route::get('settings', [HomeController::class, 'settings'])->name('settings');
        Route::get('settings/channel', [HomeController::class, 'channel'])->name('settings.channel');
        Route::post('settings/channel/install/{channel}', [HomeController::class, 'install'])->name('settings.channel.install');
        Route::get('settings/profile',    [HomeController::class, 'profile'])->name('settings.profile');


        Route::resource('settings/roles', RoleController::class);
        Route::resource('settings/permissions', PermissionController::class);
        Route::resource('settings/users', UserController::class);




        Route::get('channels/{channel}/', [HomeController::class, 'channels'])->name('channels.show');
        Route::get('channels/{channel}/{conversation}', [HomeController::class, 'conversation'])->name('channels.conversation');



    });
