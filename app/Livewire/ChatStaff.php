<?php

namespace App\Livewire;

use Livewire\Component;
use App\Events\ReceiveChat;
use Illuminate\Support\Facades\DB;

class ChatStaff extends Component
{
    public $users;
    public $messages;
    public $room;
    public $message;
    public $totalUnRead;
    public $keyword = '';

    public function mount()
    {
        $this->users = DB::table('users')->where('level', 'customer')->where('name', 'like', '%'.$this->keyword.'%')->get();
        foreach ($this->users as $user) {
            $user->lastChat = DB::table('chat')->select(['message', 'created_at'])->where('sender_id', $user->id)->orWhere('receiver_id', $user->id)->orderBy('id', 'desc')->first();
            if($user->lastChat != null){
                $user->lastChat->created_at = date("d M", strtotime($user->lastChat->created_at));
                $user->unread = DB::table('chat')->where('sender_id', $user->id)->where('receiver_id', null)->where('is_read', 0)->count();
                $this->totalUnRead += $user->unread;
            } else {
                $user->lastChat = (object) [
                    'message' => '',
                    'created_at' => '',
                ];
                $user->unread = 0;
            }
        }
    }

    public function search()
    {
        $this->mount();
    }

    public function show($id)
    {
        $this->room = $id;
        $this->messages = DB::table('chat')->where('sender_id', $id)->orWhere('receiver_id', $id)->get();
        DB::table('chat')->where('sender_id', $id)->where('receiver_id', null)->update(['is_read' => 1]);
        foreach($this->users as $user){
            if($user->id == $id){
                $this->totalUnRead -= $user->unread;
                $user->unread = 0;
            }
        }
    }

    public function getListeners()
    {
        return [
            "echo:chat.staff,ReceiveChat" => 'receiveChat',
        ];
    }
    public function receiveChat($event)
    {
        $chat = DB::table('chat')->where('id', $event['id'])->first();
        if ($this->room == $event['sender']) {
            DB::table('chat')->where('id', $event['id'])->update(['is_read' => 1]);
            $this->messages->push($chat);
        }
        foreach($this->users as $user){
            if($user->id == $event['sender']){
                $user->lastChat->message = $chat->message;
                $user->lastChat->created_at = date("d M", strtotime($chat->created_at));
                if($chat->is_read == 0 AND $this->room != $event['sender']){
                    $user->unread++;
                    $this->totalUnRead++;
                }
            }
        }        
    }

    public function save()
    {
        $id = DB::table('chat')->insertGetId([
            'sender_id' => auth()->user()->id,
            'receiver_id' => $this->room,
            'message' => $this->message,
            'created_at' => now(),
            'updated_at' => now(),
        ]);  
        $chat = DB::table('chat')->where('id', $id)->first();
        foreach($this->users as $user){
            if($user->id == $this->room){
                $user->lastChat->message = $chat->message;
                $user->lastChat->created_at = date("d M", strtotime($chat->created_at));
            }
        }
        $this->messages->push($chat);
        event(new ReceiveChat($this->message, auth()->user()->id, $this->room, $id));
    }

    public function render()
    {
        return view('livewire.chat-staff');
    }
}
