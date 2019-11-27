<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;
use App\Board;
use App\Post;

class ThreadContoller extends Controller
{
    //Отображение постов треда
    public function show(Request $request, $board_prefix, $thread_id)
    {
        $current_board = Board::where('prefix',$board_prefix)->get()->first();
        $current_thread = Thread::where('id',$thread_id)->get()->first();
        $posts = Post::where('thread_id',$current_thread->id)->get();
        return view('thread',['board'=>$current_board,'thread'=>$current_thread,'posts'=>$posts]);
    }

    //Отправка формы с данными поста
    public function add(Request $request, $board_prefix, $thread_id)
    {

    }
}
