<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;


class CronCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cron-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //all chats with status 0
        $chats = \App\Models\Chat::where('status', 0)->get();

        foreach ($chats as $chat) {
           try {
                 //get channel
            $channel = \App\Models\Channel::where('id', $chat->conversation->channel_id)->first();

            //get channel configuration
            $configuration = json_decode($channel->configuration);

            //get channel class
            $channelClass = Str::ucfirst($channel->name);
            //include channel class
            include_once app_path('channels') . '/' . Str::lower($channel->name) . '/channel.php';
            //create channel object
            $channelObject = new $channelClass();
            //get channel response
            $channelObject->deliver($configuration, $chat);
            //save response to chat
            $chat->status = 1;

            $chat->save();

            \Log::info('Message Delivered');

            //terminal output
            $this->info('Message Delivered');

           } catch (\Throwable $th) {
                //throw $th;
                \Log::info('Something went wrong');
                $this->info($th->getMessage());
           }
        }


    }
}
