<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\User;
use App\Thread;
use App\Board;

class BoardContoller extends Controller
{
    protected $bumplimit;

    /**
     * Отображение тредов доски
     * @param Request $request
     * @param $board_prefix
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, $board_prefix)
    {
        $current_board = Board::where('prefix',$board_prefix)->get()->first();
        $threads = Thread::where('board_id',$current_board->id)->get();
        $threads->load('posts');
        $this->bumplimit = $current_board->bumplimit;


        foreach ($threads as $thread) {
            $thread->posts = $thread->posts->
            sortBy('created_at')->
            slice(-3)->all();
        }

        $sorted_threads = $threads->sortByDesc('bumped_at');

        return view('board',['board'=>$current_board,'threads'=>$sorted_threads]);
    }

    //Создание треда
    public function add(Request $request,$board_prefix)
    {

    }
}
