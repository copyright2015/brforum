<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    //Заполняемы поля
    protected $fillable = [
        'message', 'theme', 'img', 'is_visible', 'Ip_hash', 'is_pinned_up', 'is_closed', 'is_cycled',
        'is_edited',
    ];
    //Говорим, что img будет массивом.
    protected $casts = ['img' => 'array'];

    public function board () {
        return $this->belongsTo('App\Board');
    }

    public function user () {
        return $this->belongsTo('App\User');
    }

    //posts connection
    public function posts() {
        return $this->hasMany('App\Post');
    }
}
