<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'admin',
        'password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function department(){
        return $this->hasOne(Departament::class, 'department_id');
    }

    public function meetings(){
        return $this->hasMany(Meeting::class, 'user_id');
    }
}
