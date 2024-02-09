<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use Illuminate\Support\Str;
use Termwind\Components\Raw;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function settings()
    {
        return view('settings');
    }

    public function channel()
    {



        $path = app_path('channels');
        $channels = scandir($path);


        $channels = array_filter($channels, function ($channel) {
            return !in_array($channel, ['.', '..']);
        });

        $channels = array_map(function ($channel) {

            $channel = str_replace('.php', '', $channel);

            include_once app_path('channels') . '/' . $channel . '/channel.php';

            $clannel = Str::ucfirst($channel);

            $channel = new $clannel();

            return $channel->config();

        }, $channels);


        foreach ($channels as $channel) {
            $channel->status = Channel::where('name', $channel->className)->first()?->status ?? 0;
        }



        return view('settings.channel', compact('channels'));
    }

    public function profile()
    {
        return view('settings.profile');
    }

    public function channels($channel)
    {
        $channel = Channel::where('name', $channel)->first();
        $conversations = $channel->conversations()->get();

        if (!$channel) {
            abort(404);
        }

        return view('channels.index', compact('channel', 'conversations'));
    }

    public function install($channel)
    {

        //if channel already installed
        if (Channel::where('name', $channel)->first()) {
            try{
                $channel = Str::ucfirst($channel);

                include_once app_path('channels') . '/' . Str::lower($channel) . '/channel.php';

                $clannel = new $channel();

                $clannel->deactivate();

                return back()->with('success', 'Channel uninstalled successfully');

            } catch (\Exception $e) {
                return back()->with('error', 'Channel not uninstalled');
            }

        }

        try {
            $channel = Str::ucfirst($channel);

            include_once app_path('channels') . '/' .  Str::lower($channel). '/channel.php';

            $clannel = new $channel();

            $clannel->activate();

            return back()->with('success', 'Channel installed successfully');

        } catch (\Exception $e) {
            return back()->with('error', 'Channel not installed');
        }

    }

    public function conversation(Request $request)
    {

        $channel = Channel::where('name', $request->channel)->first();
        $conversations = $channel->conversations()->get();
        $conversation = $channel->conversations()->findOrfail($request->conversation);

        return view('channels.conversation' , compact('channel', 'conversations', 'conversation'));

    }

    public function cron(){

        //http://xdroid.net/api/message?k=k-e315d78fb4c9&t=sample&c=from+google+Pixel+6a&u=http%3A%2F%2Fgoogle.com

        file_get_contents('http://xdroid.net/api/message?k=k-e315d78fb4c9&t=sample&c=from+google+Pixel+6a&u=http%3A%2F%2Fgoogle.com');



    }


}
