<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $fillable = [
        'start',
        'end'
    ];

    public function room(){
        return $this->hasOne(Room::class, 'room_id');
    }

    public function user(){
        return $this->hasOne(User::class, 'user_id');
    }
}
