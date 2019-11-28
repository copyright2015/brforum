<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Board;

class WelcomeController extends Controller
{
    //Метод для отображения галвной
    public function show()
    {
        $boards = Board::all();

        return view('welcome',['boards'=>$boards]);
    }

    //Метод для авторизации с главной
    public function login()
    {

    }
}
