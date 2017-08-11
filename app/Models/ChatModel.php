<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatModel extends Model
{
    protected $table    = 'chat';
    public $primaryKey  = 'id';
    protected $fillable = [
        'chat_type', 'is_active'
    ];

    const PRIVATE   = 1;
    const GROUP     = 2;

    public function user(){
        return $this->hasMany(ChatUserModel::class);
    }

    public function message(){
        return $this->hasMany(ChatMessageModel::class);
    }
}
