<?php

namespace App\Http\Controllers;

use App\Globalset;
use App\Post;
use App\Stat;
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
        $global = Globalset::find(1)->first();

        $boards = Board::all();
        foreach ($boards as $board){
            $stats[$board->prefix] = Stat::where('board_prefix', $board->prefix)->get()->first();
        }

        $dateS = new Carbon('today');
        $threads = Thread::whereBetween('bumped_at', [$dateS->format('Y-m-d')." 00:00:00", $dateS->format('Y-m-d')." 23:59:59"])->limit(50)->get();
        foreach ($threads as $thread){
            $thread->load('board');
            $thread->load('posts');
        }
        return view('welcome',[
            'boards' => $boards,
            'stats' => $stats,
            'global' => $global,
            'lastThreads' => $threads,
        ]);
    }

    //Метод для авторизации с главной
    public function login()
    {

    }
}
