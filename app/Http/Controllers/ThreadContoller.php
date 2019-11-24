<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThreadContoller extends Controller
{
    //Отображение постов треда
    public function show(Request $request, $board_prefix, $thread_id)
    {
        return view('thread',['name'=>$board_prefix,'thread'=>$thread_id]);
    }

    //Отправка формы с данными поста
    public function add(Request $request, $board_prefix, $thread_id)
    {

    }
}
