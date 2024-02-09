<?php

use App\Models\Channel;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class Messenger
{
    public function config()
    {
        $config = new stdClass();
        $config->name        = "Messenger Channel";
        $config->description = "Manage your Messenger Account";
        $config->version     = "1.0.0";
        $config->author      = "Mashikur Rahman";
        $config->icon = "fab fa-facebook-messenger";
        $config->className  = "Messenger";


        return $config;
    }

    public function activate()
    {
        //insert data to channels table
        $channel = new Channel();
        $channel->name = "Messenger";
        $channel->icon = "fab fa-facebook-messenger";
        $channel->configuration = json_encode([
            "api_key"    => "",
            "api_secret" => "",
            "api_token"  => "",
            "api_url"    => "",
        ]);
        $channel->status = 1;
        $channel->save();
    }

    public function deactivate()
    {
        //delete data from channels table
        $channel = Channel::where('name', 'Messenger')->first();
        $channel->delete();
    }

    public function send($msg, $conversation_id)
    {

        //get channel name
        $channel = Channel::where('name', 'Messenger')->first();

        $user = User::where('name', $channel->name)->first();

        $message = new Chat();
        $message->content = $msg;
        $message->status = 0;
        $message->conversation_id = $conversation_id;
        $message->user_id = $user->id;
        $message->save();

        return true;
    }

    public function deliver($configuration, $chat)
    {

    //     curl -i -X POST "https://graph.facebook.com/LATEST-API-VERSION/PAGE-ID/messages
    // ?recipient={'id':'PSID'}
    // &messaging_type=RESPONSE
    // &message={'text':'hello,world'}
    // &access_token=PAGE-ACCESS-TOKEN


   

    $configuration->page_id = "215383731659192"; 

    $configuration->page_access_token ="EAAZAaB0lTQfABOyfcEU5ZAOWHj0X9yupDH0RVfAWTgkHPyCuD2F3ZAhygT75SqWeZAZAMybpCJJzi4HGjc47J3fB3jeSeCFEQOn6ZAMZAqIkSZBt5ZATTAuZBVe4lJQmlGZBnTQhQ228PE0rr10g6cKch76B6LDRckjla6XEQcXDE8KhOZAUA930ZBBajB7oy0kfFk9TW";



    //get all messages status 0
    $messages = Chat::where('conversation_id', $chat->conversation_id)->where('status', 0)->orderBy('id', 'asc')->get();


    //foreach message send to messenger

    foreach ($messages as $message) {

       
        $receiver = Chat::where('conversation_id', $chat->conversation_id)->where('user_id', '!=', $message->user_id)->orderBy('id', 'desc')->first();

        //log
        \Log::info("Receiver: " . $receiver->user->name);
        \Log::info("Message: " . $message->content);

        $url = "https://graph.facebook.com/v19.0/". $configuration->page_id ."/messages?access_token=". $configuration->page_access_token;

        $data = [
            "recipient" => [
                "id" => $receiver->user->name
            ],
            "message" => [
                "text" => $message->content
            ]
        ];

        //send message to messenger
        $response = Http::post($url, $data);

        //log

        \Log::info("recipient: " . $receiver->user->name);
        \Log::info("Response: " . $response->body());

        

        //update message status
        $message->status = 1;
        $message->save();

    }



    

        


    }
}
