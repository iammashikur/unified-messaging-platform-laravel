<?php

use App\Models\Channel;

class Viber
{
    public function config()
    {
        $config = new stdClass();
        $config->name        = "Viber Channel";
        $config->description = "Manage your Viber Account";
        $config->version     = "1.0.0";
        $config->author      = "Mashikur Rahman";
        $config->icon = "fab fa-viber";
        $config->className  = "Viber";



        return $config;
    }

    public function activate()
    {
        //insert data to channels table
        $channel = new Channel();
        $channel->name = "Viber";
        $channel->icon = "fab fa-viber";
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
        $channel = Channel::where('name', 'Viber')->first();
        $channel->delete();
    }
}
