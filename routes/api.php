<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\ChannelController;
use App\Http\Controllers\Api\UserChatsController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\ConversationController;
use App\Http\Controllers\Api\ConversationChatsController;
use App\Http\Controllers\Api\ChannelConversationsController;
use App\Http\Controllers\Api\UserUserConversationsController;
use App\Http\Controllers\Api\ConversationUserConversationsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('permissions', PermissionController::class);

        Route::apiResource('users', UserController::class);

        // User Chats
        Route::get('/users/{user}/chats', [
            UserChatsController::class,
            'index',
        ])->name('users.chats.index');
        Route::post('/users/{user}/chats', [
            UserChatsController::class,
            'store',
        ])->name('users.chats.store');

        // User User Conversations
        Route::get('/users/{user}/user-conversations', [
            UserUserConversationsController::class,
            'index',
        ])->name('users.user-conversations.index');
        Route::post('/users/{user}/user-conversations', [
            UserUserConversationsController::class,
            'store',
        ])->name('users.user-conversations.store');

        Route::apiResource('channels', ChannelController::class);

        // Channel Conversations
        Route::get('/channels/{channel}/conversations', [
            ChannelConversationsController::class,
            'index',
        ])->name('channels.conversations.index');
        Route::post('/channels/{channel}/conversations', [
            ChannelConversationsController::class,
            'store',
        ])->name('channels.conversations.store');

        Route::apiResource('conversations', ConversationController::class);

        // Conversation Chats
        Route::get('/conversations/{conversation}/chats', [
            ConversationChatsController::class,
            'index',
        ])->name('conversations.chats.index');
        Route::post('/conversations/{conversation}/chats', [
            ConversationChatsController::class,
            'store',
        ])->name('conversations.chats.store');

        // Conversation User Conversations
        Route::get('/conversations/{conversation}/user-conversations', [
            ConversationUserConversationsController::class,
            'index',
        ])->name('conversations.user-conversations.index');
        Route::post('/conversations/{conversation}/user-conversations', [
            ConversationUserConversationsController::class,
            'store',
        ])->name('conversations.user-conversations.store');
    });
