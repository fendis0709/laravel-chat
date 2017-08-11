<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatTypeModel extends Model
{
    protected $table    = 'chat_type';
    public $primaryKey  = 'id';
    protected $fillable = [
        'name'
    ];

    public function chat(){
        return $this->hasMany(ChatModel::class);
    }
}
