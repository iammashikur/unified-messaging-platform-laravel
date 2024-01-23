<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Chats extends Component
{
    public $conversation;

    public $lastMessageID = 0;

    public function mount($conversation)
    {
        $this->conversation = $conversation;
    }

    public function render()
    {
        return view('livewire.chats', [
            'chats' => $this->conversation->chats()->get(),
        ]);
    }

    public function checkUpdate()
    {

        if($this->lastMessageID < $this->getLastMessageID())
        {
            $this->lastMessageID = $this->getLastMessageID();

            $this->emit('newMessage');

            //render the view
            $this->render();
        }

    }

    private function getLastMessageID()
    {
        $lastMsg = $this->conversation->chats()->latest()->first();

        return $lastMsg ? $lastMsg->id : 0;

    }
}
