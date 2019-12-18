<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Globalset extends Model
{
    //
    protected $fillable = [
        'file_size_limit', 'about_text', 'rules_text',
    ];
}
