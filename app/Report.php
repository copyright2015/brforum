<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    //

    protected $fillable = [
        'case', 'post_id',
    ];

    public function post () {
        return $this->belongsTo('App\Post');
    }
}
