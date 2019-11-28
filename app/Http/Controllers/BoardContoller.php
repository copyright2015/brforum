<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\User;
use App\Thread;
use App\Board;

class BoardContoller extends Controller
{
    //Отображение тредов доски
    public function show(Request $request, $board_prefix)
    {
//        $user = User::all()->first();
//        dump($user);
        $current_board = Board::where('prefix',$board_prefix)->get()->first();
//        dump($current_board);
        $threads = Thread::where('board_id',$current_board->id)->get();
        $threads->load('posts')->limit(3);
        foreach ($threads as $thread){
            dump($thread->posts);
        }


        return view('board',['board'=>$current_board,'threads'=>$threads]);
    }

    //Создание треда
    public function add(Request $request,$board_prefix)
    {

    }
}
