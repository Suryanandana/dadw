<?php

namespace App\Livewire;

use Livewire\Component;
use App\Events\ReceiveChat;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Chat extends Component
{
    public $user_id;
    public $chats = [];
    public $message;

    public function mount()
    {
        $this->user_id = Auth::user()->id;
        $this->chats = DB::table('chat')
            ->where('sender_id', $this->user_id)
            ->orWhere('receiver_id', $this->user_id)
            ->get();
    }
    public function getListeners()
    {
        return [
            "echo:chat.{$this->user_id},ReceiveChat" => 'receiveChat',
        ];
    }
    public function receiveChat($event)
    {
        $chat = DB::table('chat')->where('id', $event['id'])->first();
        $this->chats->push($chat);
    }

    public function save()
    {
        $id = DB::table('chat')->insertGetId([
            'sender_id' => $this->user_id,
            'receiver_id' => null,
            'message' => $this->message,
            'created_at' => now(),
            'updated_at' => now(),
        ]);  
        $this->message = 'da';
        $this->reset('message');
        $chat = DB::table('chat')->where('id', $id)->first();
        $this->chats->push($chat);
        event(new ReceiveChat($this->message, $this->user_id, "staff", $id));        
    }

    public function render()
    {
        return view('livewire.chat');
    }
}