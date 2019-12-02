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
    protected $bumplimit;

    public function show(Request $request, $board_prefix)
    {
//        $user = User::all()->first();
//        dump($user);
        $current_board = Board::where('prefix',$board_prefix)->get()->first();
//        dump($current_board);
        $threads = Thread::where('board_id',$current_board->id)->get();
        $threads->load('posts');
        $this->bumplimit = $current_board->bumplimit;


        foreach ($threads as $thread) {
            $thread->posts = $thread->posts->
            sortBy('created_at')->
            slice(-3)->all();
//            filter(function ($value, $key) {return $key   -2;})->all();
        }

//        dump($posts);

//        foreach ($threads as $thread){
//            dump($thread->posts);
//        }



        $sorted_threads = $threads->sortByDesc('bumped_at');

        dump($sorted_threads);




        return view('board',['board'=>$current_board,'threads'=>$sorted_threads]);
    }

    //Создание треда
    public function add(Request $request,$board_prefix)
    {

    }
}
