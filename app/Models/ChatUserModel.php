<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ChatUserModel extends Model
{
    protected $table    = 'chat_user';
    public $primaryKey  = 'id';
    protected $fillable = [
        'chat_id', 'user_id'
    ];

    public function chat(){
        return $this->belongsTo(ChatModel::class, 'chat_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function checkPrivateChatMember($from, $to){
        $chat_user_from = self::where('user_id', $from)->first();
        $chat_user_to   = self::where('user_id', $to)->first();
        if($chat_user_from !== null && $chat_user_to !== null){
            if($chat_user_from->chat_id == $chat_user_to->chat_id){
                return $chat_user_from->chat_id;
            }
        }
        return false;
    }
}
