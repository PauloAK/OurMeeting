<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departament extends Model
{
    protected $fillable = [
        'name'
    ];

    public function users(){
        return $this->hasMany(User::class, 'department_id');
    }
}
