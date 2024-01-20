<?php

use App\Models\Channel;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


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


    // curl https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=$API_KEY \
    // -H 'Content-Type: application/json' \
    // -X POST \
    // -d '{
    //   "contents": [
    //     {"role":"user",
    //      "parts":[{
    //        "text": "Write the first line of a story about a magic backpack."}]},
    //     {"role": "model",
    //      "parts":[{
    //        "text": "In the bustling city of Meadow brook, lived a young girl named Sophie. She was a bright and curious soul with an imaginative mind."}]},
    //     {"role": "user",
    //      "parts":[{
    //        "text": "Can you set it in a quiet village in 1600s France?"}]},
    //   ]
    // }' 2> /dev/null | grep "text"


    public function send($msg, $conversation_id){


        $api_key = "AIzaSyAfUc4U1GCsZgM1syxqLoGMfahYUy5w-pw"; // Replace with your actual API key

            $url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=' . $api_key;

            //with conversation id

            //get previous messages order by oldes
            $messages = Chat::where('conversation_id', $conversation_id)->orderBy('id', 'asc')->get();

            $contents = [];

            if(!empty($messages)){
                foreach($messages as $message){

                    if($message->user_id == auth()->user()->id){
                        $contents[] = ['role' => 'user', 'parts' => [['text' => $message->content]]];
                    }else{
                        $contents[] = ['role' => 'model', 'parts' => [['text' => $message->content]]];
                    }
                }
            }else{
                $contents[] = ['role' => 'user', 'parts' => [['text' => $msg]]];
            }

            $data = ['contents' => $contents];

            //merge new chat
            $data['contents'][] = ['role' => 'user', 'parts' => [['text' => $msg]]];


            $options = [
                'http' => [
                    'header' => "Content-type: application/json\r\n",
                    'method' => 'POST',
                    'content' => json_encode($data),
                ],
            ];

            $context = stream_context_create($options);
            $response = file_get_contents($url, false, $context);


            $message = new Chat();
            $message->content = $msg;
            $message->status = 1;
            $message->conversation_id = $conversation_id;
            $message->user_id = auth()->user()->id;
            $message->save();


            //check if user exists by class name
            $user = User::where('name', 'Gemini')->first();

            if(empty($user)){
                $user = new User();
                $user->name = "Gemini";
                $user->email = "gemini@ai.chat";
                $user->password = Hash::make('12345678');
                $user->save();
            }


            //response

            // { "candidates": [ { "content": { "parts": [ { "text": "Howdy! How can I assist you today?" } ], "role": "model" }, "finishReason": "STOP", "index": 0, "safetyRatings": [ { "category": "HARM_CATEGORY_SEXUALLY_EXPLICIT", "probability": "NEGLIGIBLE" }, { "category": "HARM_CATEGORY_HATE_SPEECH", "probability": "NEGLIGIBLE" }, { "category": "HARM_CATEGORY_HARASSMENT", "probability": "NEGLIGIBLE" }, { "category": "HARM_CATEGORY_DANGEROUS_CONTENT", "probability": "NEGLIGIBLE" } ] } ], "promptFeedback": { "safetyRatings": [ { "category": "HARM_CATEGORY_SEXUALLY_EXPLICIT", "probability": "NEGLIGIBLE" }, { "category": "HARM_CATEGORY_HATE_SPEECH", "probability": "NEGLIGIBLE" }, { "category": "HARM_CATEGORY_HARASSMENT", "probability": "NEGLIGIBLE" }, { "category": "HARM_CATEGORY_DANGEROUS_CONTENT", "probability": "NEGLIGIBLE" } ] } }


            $markdown = "";

            try{
                $markdown = json_decode($response)->candidates[0]->content->parts[0]->text;
                //markdown to html
            }catch(Exception $e){
                $markdown = "Sorry, I don't understand.";
            }

                //insert message to database
                $message = new Chat();
                $message->content = $markdown;
                $message->status = 1;
                $message->conversation_id = $conversation_id;
                $message->user_id = $user->id;
                $message->save();



            return true;

    }
}
