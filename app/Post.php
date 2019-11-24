<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = [
        'message', 'theme', 'img', 'is_visible', 'theme', 'mod_notice', 'is_edited', 'is_sage',
        'Ip_hash'
    ];

    //Говорим, что img будет массивом.
    protected $casts = ['img' => 'array'];

    public function user () {
        return $this->belongsTo('App\User');
    }

    public function thread () {
        return $this->belongsTo('App\Thread');
    }
}
