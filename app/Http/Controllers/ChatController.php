<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Chat;


class ChatController extends Controller
{

    public function send(Request $request)
    {

        try{

        $request->validate([
            'content' => 'required',
        ]);



        Chat::create([
            'content' => $request->content,
            'user_id' => auth()->user()->id,
            'conversation_id' => $request->id,
            'status' => 1,

        ]);


        return redirect()->back()->with('success', 'Message sent successfully.');




        } catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


}
