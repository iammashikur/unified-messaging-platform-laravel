<?php

use App\Models\Channel;

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
}
