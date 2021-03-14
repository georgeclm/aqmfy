<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;
    public function room()
    {
        // second parameter for foreign key and third param is the local key
        return $this->hasOne(ChatRoom::class, 'id', 'chat_room_id');
    }
    public function user()
    {
        // second parameter for foreign key and third param is the local key
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
