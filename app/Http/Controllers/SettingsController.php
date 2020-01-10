<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class SettingsController extends Controller
{
    //
    public function show()
    {

        return view('usersettings');
    }

    public function save(Request $request)
    {

    }
}
