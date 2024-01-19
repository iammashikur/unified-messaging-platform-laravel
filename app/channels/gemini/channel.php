<?php

use App\Models\Channel;

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
}
