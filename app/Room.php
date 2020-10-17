<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'name'
    ];

    public function meetings(){
        return $this->hasMany(Meeting::class, 'room_id');
    }
}
