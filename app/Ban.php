<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ban extends Model
{
    //
    //Заполняемыe поля
    protected $fillable = [
        'ip_hash', 'is_404_ban'
    ];

    public function user () {
        return $this->belongsTo('App\User');
    }
}
