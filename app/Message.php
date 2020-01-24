<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $fillable = [
        'text', 'title', 'is_readed', 'user_id'
    ];

    public function user () {
        return $this->belongsTo('App\User');
    }
}