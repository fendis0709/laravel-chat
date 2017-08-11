<?php

namespace App;

use App\Models\ChatMessageModel;
use App\Models\ChatUserModel;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function chat_message(){
        return $this->hasMany(ChatMessageModel::class);
    }

    public function chat_user(){
        return $this->hasMany(ChatUserModel::class);
    }
}
