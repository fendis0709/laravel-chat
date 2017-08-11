<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ChatMessageModel extends Model
{
    protected $table    = 'chat_message';
    public $primaryKey  = 'id';
    protected $fillable = [
        'chat_id', 'user_id', 'message', 'message_type'
    ];

    const TEXT          = 'text';
    const ATTACHMENT    = 'attachment';

    public function chat(){
        return $this->belongsTo(ChatModel::class, 'chat_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
