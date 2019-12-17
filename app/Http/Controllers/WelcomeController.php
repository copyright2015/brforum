<?php

namespace App\Http\Controllers;

use App\Thread;
use App\User;
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

        $boards = Board::all();
        foreach ($boards as $board){
            $board->load('threads');
            foreach ($board->threads as $thread){
                $thread->load('posts');
                $postsCount = $postsCount + count($thread->posts);
            }
        }
        return view('welcome',[
            'boards' => $boards,
            'lastPosts' => $lastPosts,
            'postCount' => $postsCount
        ]);
    }

    //Метод для авторизации с главной
    public function login()
    {

    }
}
