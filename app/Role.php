<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    //Заполняемы поля
    protected $fillable = [
        'name', 'sign', 'img', 'board_prefix',
    ];

    public function users () {
        return $this->hasMany('App\User');
    }
}
