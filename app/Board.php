<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    //
    protected $fillable = [
        'name', 'prefix', 'description', 'is_visible', 'for_regs', 'bumplimit', 'only_tor', 'thread_limit_per_hour',
        'picture_limit', 'default_user_name', 'slogan'
    ];
    //threads connection
    public function threads() {
        return $this->hasMany('App\Thread');
    }
    //banners connection
    public function banners() {
        return $this->hasMany('App\Banner');
    }
}
