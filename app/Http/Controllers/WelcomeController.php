<?php

namespace App\Http\Controllers;

use App\Globalset;
use App\Post;
use App\Thread;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Board;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    //Метод для отображения галвной
    public function show()
    {
        $postsCount = 0;
        $lastPosts = 0;

        $global = Globalset::find(1)->first();

        $boards = Board::all();
        foreach ($boards as $board){
            $board->load('threads');
            foreach ($board->threads as $thread){
                $thread->load('posts');
                $postsCount = $postsCount + count($thread->posts);
            }
        }
        $dateS = new Carbon('today');
        $threads = Thread::whereBetween('bumped_at', [$dateS->format('Y-m-d')." 00:00:00", $dateS->format('Y-m-d')." 23:59:59"])->limit(50)->get();
        foreach ($threads as $thread){
            $thread->load('board');
            $thread->load('posts');
        }
        return view('welcome',[
            'boards' => $boards,
            'lastPosts' => $lastPosts,
            'postCount' => $postsCount,
            'global' => $global,
            'lastThreads' => $threads,
        ]);
    }

    //Метод для авторизации с главной
    public function login()
    {

    }
}
