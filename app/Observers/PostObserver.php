<?php

namespace App\Observers;

use App\Board;
use App\Post;
use App\Thread;

class PostObserver
{
    /**
     * Handle the post "created" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function created(Post $post)
    {
        //
        $thread_to_bump = Thread::where('id',$post->thread_id)->get()->first();
        $current_board = Board::where('id',$thread_to_bump->board_id)->get()->first();
        if((count($thread_to_bump->posts) < $current_board->bumplimit) && (!$post->is_sage)) {
            $thread_to_bump->bumped_at = now();
            $thread_to_bump->save();
        }
    }

    /**
     * Handle the post "updated" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function updated(Post $post)
    {
        //
    }

    /**
     * Handle the post "deleted" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function deleted(Post $post)
    {
        //
    }

    /**
     * Handle the post "restored" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function restored(Post $post)
    {
        //
    }

    /**
     * Handle the post "force deleted" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function forceDeleted(Post $post)
    {
        //
    }
}