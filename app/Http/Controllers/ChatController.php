<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Conversation;
use App\Models\Channel;
use Illuminate\Support\Str;

class ChatController extends Controller
{

    public function send(Request $request)
    {

        try{

        $request->validate([
            'content' => 'required',
        ]);


        //get conversation
        $conversation = Conversation::find($request->id);
        //get channel
        $channel = $conversation->channel;

        //load channel class


        include_once app_path('channels') . '/' . $channel->name . '/channel.php';

        $class = Str::ucfirst($channel->name);

        $channel = new $class();

        if($channel->send($request->content, $conversation->id)){
            return redirect()->back()->with('success', 'Message sent successfully.');
        }

        } catch(Exception $e){
            return redirect()->back()->with('error', 'Message not sent.');
        }
    }


}
