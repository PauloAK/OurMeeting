<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $fillable = [
        'start',
        'end'
    ];

    protected $dates = [
        'start',
        'end',
    ];

    public function room(){
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
