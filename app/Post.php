<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Listeners\PostSaved;

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


//    protected $dispatchesEvents = [
//        'saved' => PostSaved::class
//    ];

    /**
     * Привязка сабытия на добавление поста, которое бампает тред
     */
//    protected static function boot()
//    {
//        parent::boot();
//        Post::saved(function ($model) {
//
//            $thread_to_bump = Thread::where('id',$model->thread_id)->get()->first();
//            $current_board = Board::where('id',$thread_to_bump->board_id)->get()->first();
//            if((count($thread_to_bump->posts) < $current_board->bumplimit) && (!$model->is_sage)) {
//                $thread_to_bump->bumped_at = now();
//                $thread_to_bump->save();
//            }
//
//        });
//    }

}
