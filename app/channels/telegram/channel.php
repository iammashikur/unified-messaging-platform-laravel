<?php

use App\Models\Channel;

class Telegram
{
    public function config()
    {
        $config = new stdClass();
        $config->name        = "Telegram Channel";
        $config->description = "Manage your Telegram Account";
        $config->version     = "1.0.0";
        $config->author      = "Mashikur Rahman";
        $config->icon = "fab fa-telegram";
        $config->className  = "Telegram";


        return $config;
    }

    public function activate()
    {
        //insert data to channels table
        $channel = new Channel();
        $channel->name = "Telegram";
        $channel->icon = "fab fa-telegram";
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
        $channel = Channel::where('name', 'Telegram')->first();
        $channel->delete();
    }
}
