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
use Illuminate\Support\Facades\Http;

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


Route::any('web-hook', function () {


    //accept cors
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: *");


    //http://xdroid.net/api/message?k=k-e315d78fb4c9&t=sample&c=from+google+Pixel+6a&u=http%3A%2F%2Fgoogle.com

    //log request
    \Log::info(request()->all());

    try {
        //create conversation if not exist by conversation name 215383731659192
        $conversation = \App\Models\Conversation::where('name', request()->entry[0]['id'])->first();


        if(empty($conversation)){
            $conversation = new \App\Models\Conversation();
            $conversation->name = request()->entry[0]['id'];
            $conversation->channel_id = 1;
            $conversation->save();
        }


        if (request()->entry[0]['messaging'][0]['recipient']['id'] == request()->entry[0]['id']) {

            $user = \App\Models\User::where('name', request()->entry[0]['messaging'][0]['sender']['id'])->first();

            if(empty($user)){
                $user = new \App\Models\User();
                $user->name = request()->entry[0]['messaging'][0]['sender']['id'];
                $user->email = request()->entry[0]['messaging'][0]['sender']['id'] . '@facebook.com';
                $user->password = \Hash::make('password');
                $user->save();
            }

            //save message to database
            $chat = new \App\Models\Chat();
            $chat->content = request()->entry[0]['messaging'][0]['message']['text'];
            $chat->status = 1;
            $chat->conversation_id = $conversation->id;
            $chat->user_id = $user->id;
            $chat->save();

        }else{

            $user = \App\Models\User::where('name', 'Messenger')->first();

            if(empty($user)){
                $user = new \App\Models\User();
                $user->name = "Messenger";
                $user->email = "messender@facebook.com";
                $user->password = \Hash::make('password');
                $user->save();
            }

            //check if last message == current message
            $lastMessage = \App\Models\Chat::where('conversation_id', $conversation->id)->orderBy('id', 'desc')->first();

            if($lastMessage->content == request()->entry[0]['messaging'][0]['message']['text']){
                return;
            }

            //save message to database
            $chat = new \App\Models\Chat();
            $chat->content = request()->entry[0]['messaging'][0]['message']['text'];
            $chat->status = 1;
            $chat->conversation_id = $conversation->id;
            $chat->user_id = $user->id;
            $chat->save();
        }




    } catch (\Throwable $th) {
        \Log::info('Webhook Message Error');
    }
});

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
