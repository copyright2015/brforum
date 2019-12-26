<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    //
    protected $fillable = [
        'board_prefix', 'total_posts', 'posters', 'posts_per_hour',
    ];
}
