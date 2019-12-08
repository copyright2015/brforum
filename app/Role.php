<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    //Заполняемы поля
    protected $fillable = [
        'name', 'sign', 'board_prefix',
    ];


    public function users(){
        return $this->belongsToMany('App\User','role_user', 'role_id','user_id');
    }

}
