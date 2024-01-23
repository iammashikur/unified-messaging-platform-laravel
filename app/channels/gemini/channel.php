<?php

use App\Models\Channel;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class Gemini
{
    public function config()
    {
        $config = new stdClass();
        $config->name        = "Gemini Channel";
        $config->description = "Chat with gemini AI, powered by Google";
        $config->version     = "1.0.0";
        $config->author      = "Mashikur Rahman";
        $config->icon = "fa-brands fa-google";
        $config->className  = "Gemini";


        return $config;
    }

    public function activate()
    {
        //insert data to channels table
        $channel = new Channel();
        $channel->name = "Gemini";
        $channel->icon = "fa-brands fa-google";
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
        $channel = Channel::where('name', 'Gemini')->first();
        $channel->delete();
    }


    public function send($msg, $conversation_id){

            //get last message
            $lastMessage = Chat::where('conversation_id', $conversation_id)->orderBy('id', 'desc')->first();

            //check if last message is from user
            if(!empty($lastMessage) && $lastMessage->user_id == auth()->user()->id){
               throw new Exception("You can't send two messages at a time. this AI is dumb.");
            }

            $message = new Chat();
            $message->content = $msg;
            $message->status = 0;
            $message->conversation_id = $conversation_id;
            $message->user_id = auth()->user()->id;
            $message->save();

            return true;
    }


    public function deliver($configuration, $chat){

        $apiKey = 'AIzaSyAfUc4U1GCsZgM1syxqLoGMfahYUy5w-pw';

        //generate content from previous messages
        $messages = Chat::where('conversation_id', $chat->conversation_id)->where('id', '<=', $chat->id)->orderBy('id', 'asc')->get();


        if(!empty($messages)){
            $lastMessage = $messages->last();
            if($lastMessage->user->name == "Gemini"){
                log::info("Gemini already replied");
                return true;
            }
        }

        $contents = [];

        if(!empty($messages)){
            foreach($messages as $message){

                if($message->user->name !== "Gemini"){
                    $contents[] = ['role' => 'user', 'parts' => [['text' => $message->content]]];
                }else{
                    $contents[] = ['role' => 'model', 'parts' => [['text' => $message->content]]];
                }
            }
        }else{
            $contents[] = ['role' => 'user', 'parts' => [['text' => $chat->content]]];
        }

        $data = ['contents' => $contents];

        $response = Http::post('https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=' . $apiKey, $data);

        //check if user exists by class name
        $user = User::where('name', 'Gemini')->first();

        if(empty($user)){
            $user = new User();
            $user->name = "Gemini";
            $user->email = "gemini@ai.chat";
            $user->password = Hash::make('12345678');
            $user->save();
        }

        $markdown = "";

        try{
            $markdown = json_decode($response->body())->candidates[0]->content->parts[0]->text;
            //markdown to html
        }catch(Exception $e){
            $markdown = "Sorry, I don't understand.";
        }

            //insert message to database
            $message = new Chat();
            $message->content = $markdown;
            $message->status = 1;
            $message->conversation_id = $chat->conversation_id;
            $message->user_id = $user->id;
            $message->save();

        return true;

    }

}
