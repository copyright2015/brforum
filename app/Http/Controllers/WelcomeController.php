<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    //Метод для отображения галвной
    public function show()
    {
        return view('welcome');
    }

    //Метод для авторизации с главной
    public function login()
    {

    }
}
