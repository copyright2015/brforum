<?php

namespace App\Observers;

use App\Board;
use App\Post;
use App\Stat;
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


        //Получаем инфу о доске и треде поста.
        $current_thread = Thread::where('id',$post->thread_id)->get()->first();
        $current_board = Board::where('id',$current_thread->board_id)->get()->first();

        //Удаляем старые посты в цилкичных тредах.
        if($current_thread->is_cycled) {
            if(count($current_thread->posts) == $current_board->bumplimit){
              Post::where('thread_id',$current_thread->id)->first()->delete();
            }
        }

        //Бампаем тред
        if((count($current_thread->posts) < $current_board->bumplimit) && (!$post->is_sage)) {
            $current_thread->bumped_at = now();
            $current_thread->save();
        }

        //Обновление общего количества постов
        $stat =  Stat::where('board_prefix', $current_board->prefix)->get()->first();
        $stat->total_posts = $stat->total_posts+1;
        $stat->save();


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
