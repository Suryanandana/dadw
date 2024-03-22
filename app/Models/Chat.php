<?php

namespace App\Models;

use App\Events\ReceiveChat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chat extends Model
{
    use HasFactory;

    protected $table = 'chat';

    protected $fillable = [
        'message',
        'sender_id',
        'receiver_id',
        'is_read'
    ];

    protected static function booted(): void
    {
        static::created(function (Chat $chat) {
            event(new ReceiveChat($chat->message, $chat->sender_id, $chat->receiver_id, $chat->id));
        });
    }
}
