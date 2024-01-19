<?php

use App\Models\Channel;

class Whatsapp
{
    public function config()
    {
        $config = new stdClass();
        $config->name        = "Whatsapp Channel";
        $config->description = "Manage your Whatsapp Business Account";
        $config->version     = "1.0.0";
        $config->author      = "Mashikur Rahman";
        $config->icon = "fab fa-whatsapp";
        $config->className  = "Whatsapp";


        return $config;
    }

    public function activate()
    {
        //insert data to channels table
        $channel = new Channel();
        $channel->name = "Whatsapp";
        $channel->icon = "fab fa-whatsapp";
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
        $channel = Channel::where('name', 'Whatsapp')->first();
        $channel->delete();
    }
}


