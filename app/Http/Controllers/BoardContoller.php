<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class BoardContoller extends Controller
{
    //Отображение тредов доски
    public function show(Request $request, $board_prefix)
    {
//        $user = User::all()->first();
//        dump($user);
        return view('board',['name'=>$board_prefix]);
    }

    //Создание треда
    public function add(Request $request,$board_prefix)
    {

    }
}
